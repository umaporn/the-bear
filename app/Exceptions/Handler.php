<?php
/**
 * Exception handler
 */

namespace App\Exceptions;

use App\Support\Facades\Utility;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\App;

/**
 * Application Handler
 * @package App\Exceptions
 */
class Handler extends ExceptionHandler
{
    /** @var array A list of the exception types that should not be reported. */
    protected $dontReport = [
        AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param Exception $exception Exception
     *
     * @throws Exception Exception
     */
    public function report( Exception $exception )
    {
        parent::report( $exception );
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request   HTTP request object
     * @param  \Exception               $exception Exception
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response HTTP response
     */
    public function render( $request, Exception $exception )
    {
        $errorMessage = $this->getErrorMessage( $exception );

        if( !empty( $errorMessage ) ){

            if( $request->expectsJson() ){
                return response()->json( [ 'success' => false, 'message' => $errorMessage ], 500 );
            }

            $exception = new Exception( $errorMessage, 500 );

            return response()->view( 'errors.500', compact( 'exception' ), 500 );
        }

        return parent::render( $request, $exception );
    }

    /**
     * Get a new error message.
     *
     * @param Exception $exception Exception
     *
     * @return string Error message
     */
    private function getErrorMessage( Exception $exception )
    {
        $errorMessage = '';

        switch( get_class( $exception ) ){
            case QueryException::class:
                $errorMessage = $exception->getCode() === 1045 ? __( 'exception.database_connection' ) : __( 'exception.query' );
                break;
            case \Swift_TransportException::class:
                $errorMessage = __( 'exception.mail_server_connection' );
                break;
            case ModelNotFoundException::class:
                $errorMessage = __( 'exception.model_not_found' );
                break;
        }

        return $errorMessage;
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request                 $request   HTTP request object
     * @param  \Illuminate\Auth\AuthenticationException $exception Authentication Exception
     *
     * @return \Illuminate\Http\RedirectResponse HTTP redirect response
     */
    protected function unauthenticated( $request, AuthenticationException $exception )
    {
        if( $request->expectsJson() ){
            return response()->json( [ 'error' => 'Unauthenticated.' ], 401 );
        }

        App::setLocale( Utility::getLanguageCode() );

        return redirect()->guest( route( 'login' ) );
    }
}
