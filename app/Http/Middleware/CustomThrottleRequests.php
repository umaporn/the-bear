<?php
/**
 * Custom ThrottleRequests middleware
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Routing\Middleware\ThrottleRequests;

/**
 * This class is a custom class of Illuminate\Routing\Middleware\ThrottleRequests class to modify all static data.
 * @package App\Http\Middleware
 */
class CustomThrottleRequests extends ThrottleRequests
{
    /**
     * Create an exception of too many attempts.
     *
     * @param string $key         Signature key
     * @param int    $maxAttempts Maximum attempts
     *
     * @return ThrottleRequestsException Throttle request exception
     */
    protected function buildException( $key, $maxAttempts )
    {
        $retryAfter = $this->getTimeUntilNextRetry( $key );
        $headers    = $this->getHeaders(
            $maxAttempts,
            $this->calculateRemainingAttempts( $key, $maxAttempts, $retryAfter ),
            $retryAfter
        );

        return new ThrottleRequestsException(
            __( 'exception.throttle' ), null, $headers
        );
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request      HTTP request object
     * @param  \Closure                 $next         The next request
     * @param  int|string               $maxAttempts  Maximum attempts
     * @param  float|int                $decayMinutes Decay minutes
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     * @throws \Illuminate\Http\Exceptions\ThrottleRequestsException Throttle request exception
     */
    public function handle( $request, Closure $next, $maxAttempts = 60, $decayMinutes = 1 )
    {
        $maxAttempts  = env( 'THROTTLE_ATTEMPTS_PER_MINUTE', 120 );
        $decayMinutes = env( 'THROTTLE_DECAY_MINUTES', 1 );

        return parent::handle( $request, $next, $maxAttempts, $decayMinutes );
    }

}