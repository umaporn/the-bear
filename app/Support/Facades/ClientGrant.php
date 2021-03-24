<?php
/**
 * Client Credentials Grant Facade
 */

namespace App\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is a facade class of \App\Libraries\WebServiceRequest\ClientCredentialsGrantRequest class.
 * @package App\Support\Facades
 */
class ClientGrant extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string Facade name
     */
    protected static function getFacadeAccessor()
    {
        return 'clientGrant';
    }
}
