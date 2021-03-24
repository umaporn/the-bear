<?php
/**
 * Register a user.
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMailer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\Users;

/**
 * Register User Controller
 * @package App\Http\Controllers\Auth
 */
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $usersModel;

    /**
     * Initialize RegisterController class.
     *
     * @param Users $users Users model
     */
    public function __construct( Users $users )
    {
        $this->usersModel = $users;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator( array $data )
    {
        return Validator::make( $data, [
            'email'        => config( 'validation.authentication.email' ),
            'password'     => config( 'validation.authentication.password' ),
        ] );
    }

    /**
     * Register a new user.
     *
     * @param Request $request HTTP request object
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse Registration response
     */
    public function register( Request $request )
    {
        $this->validator( $request->input() )->validate();

        event( new Registered( $user = $this->create( $request ) ) );

        Mail::to( $request->input( 'email' ) )
            ->send( new RegisterMailer( $user ) );

        if( $request->expectsJson() ){
            $message = ( $user ) ? __( 'register.form_submitted.success_message' )
                : __( 'register.form_submitted.failed_message' );

            $this->guard()->login( $user );

            return response()->json( [ 'success' => true, 'message' => $message, 'redirectedUrl' => route( 'profile.index' ) ] );
        }

        return $this->registered( $request, $user )
            ?: redirect( route( 'profile.index' ) );
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view( 'auth.register' );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param Request $request User data
     *
     * @return Users ReferralUsers model
     */
    protected function create( Request $request )
    {
        return $this->usersModel->createUser( $request );
    }

    /**
     * Process this function after the user has been registered.
     *
     * @param Request $request Form request object
     *
     * @return    \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function registered( Request $request )
    {
        if( $request->ajax() ){
            return response()->json( [ 'redirectUrl' => $this->redirectPath() ] );
        } else {
            return redirect( $this->redirectPath() );
        }
    }
}
