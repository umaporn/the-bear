<?php
/**
 * This is a controller that use for recovering password.
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

/**
 * This controller is responsible for handling password reset requests and uses a simple trait to include this behavior.
 * You're free to explore this trait and override any methods you wish to tweak.
 */
class ResetPasswordController extends Controller
{
    use ResetsPasswords {
        broker as traitBroker;
        credentials as traitCredentials;
        resetpassword as traitResetPassword;
        redirectPath as traitRedirectPath;
    }

    /** @var string Where to redirect users after reset their password */
    protected $redirectTo;

    /**
     * Initialize ResetPasswordController class
     */
    public function __construct()
    {
        $this->middleware( 'guest' );

        $this->redirectTo = route( 'login' );
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param \Illuminate\Http\Request $request
     * @param string                   $response Response message
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResetResponse( Request $request, $response )
    {
        if( $request->ajax() ){
            return response()->json( [ 'success'     => true,
                                       'message'     => __( $response ),
                                       'redirectUrl' => $this->traitRedirectPath(),
                                     ],
                                     200 );
        } else {
            return redirect( $this->traitRedirectPath() )->with( 'status', trans( $response ) );
        }
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param \Illuminate\Http\Request
     * @param string $response Response message
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResetFailedResponse( Request $request, $response )
    {
        $error = [ 'errors' => [ 'email' => __( $response ) ] ];

        if( $request->ajax() ){
            return response()->json( $error, 422 );
        } else {
            return redirect()
                ->back()
                ->withInput( $request->only( 'email' ) )
                ->withErrors( $error );
        }
    }

    /**
     * Reset the given user's password.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function reset( Request $request )
    {
        $this->validate( $request, [
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => config( 'validation.authentication.password' ),
        ] );

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->traitBroker()->reset(
            $this->traitCredentials( $request ),
            function( $user, $password ){
                $this->traitResetPassword( $user, $password );
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if( $response === Password::PASSWORD_RESET ){
            return $this->sendResetResponse( $request, $response );
        } else {
            return $this->sendResetFailedResponse( $request, $response );
        }
    }
}
