<?php
/**
 * Manage redirected page after the user has been authenticated
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Redirect the user to another page if the user has been authenticated.
 * @package App\Http\Middleware
 */
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request HTTP request object
     * @param  \Closure                 $next    Closer
     * @param  string|null              $guard   Guard name
     *
     * @return mixed
     */
    public function handle( $request, Closure $next, $guard = null )
    {
        if( Auth::guard( $guard )->check() ){
            return redirect()->route( 'dashboard.index' );
        }

        return $next( $request );
    }
}
