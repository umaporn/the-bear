<?php
/**
 * Send resetting password request.
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

/**
 * Forgot Password Controller
 * @package App\Http\Controllers\Auth
 */
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Forgot Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Send a reset link by email.
     *
     * @param Request $request HTTP RecaptchaRequest request object
     *
     * @return \Illuminate\Http\JsonResponse Sending a reset link response
     */
    public function sendResetPasswordLink( Request $request )
    {

        $response = $this->requestPasswordReset($request);

        if( isset( $response['errors'] ) ){
            return response()->json( $response, 422 );
        }

        return response()->json( [
                                     'success'       => $response['success'],
                                     'message'       => $response['message'],
                                 ] );
    }

    /**
     * Request password reset by sending password reset link in an email.
     *
     * @param Request $request      HTTP request object
     * @param string  $languageCode Language code
     *
     * @return JsonResponse Password reset request response
     */
    public function requestPasswordReset( Request $request, string $languageCode = 'en' )
    {
        App::setLocale( $languageCode );

        return $this->sendResetLinkEmail( $request );
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param Request $request  HTTP request object
     * @param string  $response Response message
     *
     * @return array HTTP response object
     */
    protected function sendResetLinkResponse( Request $request, $response )
    {
        return [ 'success' => true, 'message' => __( $response ) ];
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param Request $request  HTTP      request object
     * @param string  $response Response message
     *
     * @return array response object
     */
    protected function sendResetLinkFailedResponse( Request $request, $response )
    {
        return [ 'errors' => [ 'email' => __( $response ) ] ];
    }

    /**
     * Validate the email for the given request.
     *
     * @param Request $request HTTP request object
     */
    protected function validateEmail( Request $request ): void
    {
        $request->validate( [ 'email' => config( 'validation.user_registration.email' ) ] );
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }
}
