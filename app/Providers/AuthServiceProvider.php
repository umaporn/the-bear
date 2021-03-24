<?php
/**
 * Authentication Service Provider
 */

namespace App\Providers;

use App\Libraries\AuthenticatableUser;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

/**
 * Authentication Service Provider
 * @package App\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    /** @var array The policy mappings for the application. */
    protected $policies = [
        \App\Http\Controllers\GroupController::class => \App\Policies\HomePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::provider( 'oauth', function(){
            return new UserProvider( new AuthenticatableUser() );
        } );
    }
}
