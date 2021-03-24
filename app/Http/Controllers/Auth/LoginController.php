<?php
/**
 * Login controller
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Libraries\ServiceRequest;
use App\Models\Users;
use App\Models\Wallet;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

/**
 * Login Controller
 * @package App\Http\Controllers\Auth
 */
class LoginController extends Controller
{
    use AuthenticatesUsers {
        logout as traitLogout;
    }

    protected $usersModel;
    protected $walletModel;

    /**
     * LoginController constructor.
     *
     * @param Users $users Users model
     */
    public function __construct( Users $users, Wallet $wallet )
    {
        $this->usersModel  = $users;
        $this->walletModel = $wallet;
    }

    /**
     * Handle a login request to the application.
     *
     * @param Request $request HTTP request object
     *
     * @return Response Login response
     *
     * @throws ValidationException Validation exception
     */
    public function login( Request $request )
    {

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if( $this->hasTooManyLoginAttempts( $request ) ){
            $this->fireLockoutEvent( $request );
            $this->sendLockoutResponse( $request );
        }

        if( $this->attemptLogin( $request ) ){
            return $this->sendLoginResponse( $request );
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts( $request );
        $this->sendFailedLoginResponse( $request );
    }

    /**
     * Show the application's login form.
     *
     * @return Response
     */
    public function showLoginForm()
    {
        return view( 'auth.login' );
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request HTTP request object
     *
     * @return Response HTTP response object
     */
    public function logout( Request $request )
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut( $request ) ?: redirect( '/login' );
    }

    /**
     * Redirect the user to another page after the user has been authenticated.
     *
     * @param Request $request HTTP request object
     * @param mixed   $user    User
     *
     * @return RedirectResponse|JsonResponse HTTP response object
     */
    protected function authenticated( Request $request, $user )
    {

        $redirectedUrl = route( 'dashboard.index' );

        //if( $request->expectsJson() ){

        $redirectedUrl = session()->pull( 'url.intended', $redirectedUrl );

        return response()->json( [ 'success' => true, 'redirectedUrl' => $redirectedUrl ] );

        // }

        return redirect()->intended( $redirectedUrl );
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse( Request $request )
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts( $request );

        return $this->authenticated( $request, $this->guard()->user() )
            ?: redirect()->intended( route( 'profile.index' ) );
    }

    public function createUserFromOreid( Request $request )
    {
        $userInfo = $request->get( 'userInformation' );

        logger( '---User Information For Oreid-------------------------------------------------' );
        logger( $userInfo );

        $newUser = [
            'email'      => $userInfo['email'],
            'firstname'  => explode( ' ', $userInfo['name'] )[0],
            'lastname'   => explode( ' ', $userInfo['name'] )[1],
            'username'   => $userInfo['username'],
            'image_path' => $userInfo['picture'],
            'password'   => bcrypt( 'default' ),
            'kyc_staus'  => 'active',
        ];

        $userLoin = $this->usersModel->where( [ 'email' => $newUser['email'] ] )->get();

        $this->createWallet( $userLoin, $userInfo );

        if( $userLoin->isNotEmpty() ){

            $message = __( 'register.form_submitted.success_message' );

        } else {

            event( new Registered( $user = $this->usersModel->create( $newUser ) ) );

            $this->guard()->login( $user );

            $message = ( $user ) ? __( 'register.form_submitted.success_message' )
                : __( 'register.form_submitted.failed_message' );

        }

        return response()->json( [ 'success' => true, 'message' => $message, 'redirectedUrl' => route( 'sendLoginWithOreIDResponse', [ 'email' => $newUser['email'] ] ) ] );

    }

    public function createWallet( $userLogin, $userInfo )
    {
        logger( 'WALLET' );
        logger( $userLogin[0]->fk_wallet_id );

        if( $userLogin[0]->fk_wallet_id === null ){
            $userWallet = [
                'wallet_title' => $userInfo['permissions'][0]['chainAccount'],
                'wallet_id'    => $userInfo['accountName'],
                'wallet_token' => $userInfo['permissions'][0]['publicKey'],
            ];
            $result     = $this->walletModel->create( $userWallet );
            $this->usersModel->where( [ 'id' => $userLogin[0]->id ] )
                             ->update( [ 'fk_wallet_id' => $result->id ] );
        }
    }

    public function sendLoginWithOreIDResponse( $email )
    {

        $userLogin = $this->usersModel->where( [ 'email' => $email ] )->get();
        logger( '---User Information Fro Oreid-------------------------------------------------' );
        logger( $userLogin );
        if( $userLogin->isNotEmpty() ){

            $credentials = [ 'email' => $email, 'password' => 'default' ];

            if( Auth::attempt( $credentials ) ){
                // Authentication passed...
                return redirect()->route( 'profile.index' );
                //return redirect()->intended('profile');
            } else {
                $message = 'This user have been register with email.Please login with email again.';

                return redirect()->route( 'login' )->with( 'message', $message );

            }

            // $this->guard()->login( $userLoin );

        }

    }
}
