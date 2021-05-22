<?php
/**
 * Application Service Provider
 */

namespace App\Providers;

use App\Libraries\CustomRouteCollection;
use App\Libraries\Utility;
use App\Libraries\WebServiceRequest\ClientCredentialsGrantRequest;
use App\Libraries\WebServiceRequest\PasswordGrantRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Sitename;

/**
 * Application Service Provider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer( 'layouts.app', 'App\ViewComposers\MenuComposer' );
        View::composer( 'layouts.menu', 'App\ViewComposers\MenuComposer' );

        View::composer( 'layouts.app', 'App\ViewComposers\GtmHeaderComposer' );
        View::composer( 'layouts.app', 'App\ViewComposers\GtmBodyComposer' );

        Validator::extend( 'correct_password', 'App\Libraries\ValidationRules\Common@validatePassword' );
        Validator::extend( 'zero_or_exists', 'App\Libraries\ValidationRules\Common@validateZeroOrExistsRule' );
        Validator::extend( 'checkbox_in', 'App\Libraries\ValidationRules\Common@validateCheckboxInRule' );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['router']->setRoutes( new CustomRouteCollection() );

        $this->app->singleton( 'passwordGrant', function(){
            return new PasswordGrantRequest();
        } );

        $this->app->singleton( 'clientGrant', function(){
            return new ClientCredentialsGrantRequest();
        } );

        $this->app->singleton( 'utility', function(){
            return new Utility();
        } );
    }
}
