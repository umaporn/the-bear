<?php
/**
 * Password Grant Facade
 */

namespace App\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is a facade class of \App\Libraries\WebServiceRequest\PasswordGrantRequest class.
 * @package App\Support\Facades
 */
class PasswordGrant extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string Facade name
     */
    protected static function getFacadeAccessor()
    {
        return 'passwordGrant';
    }
}
