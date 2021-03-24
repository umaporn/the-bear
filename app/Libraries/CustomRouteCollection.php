<?php
/**
 * Customize RouteCollection class.
 */

namespace App\Libraries;

use App\Support\Facades\Utility;
use Illuminate\Routing\RouteCollection;
use Illuminate\Support\Facades\App;

/**
 * This class is a customization of RouteCollection class which use for managing route collection.
 * @package App\Libraries
 */
class CustomRouteCollection extends RouteCollection
{
    /**
     * Get a route instance by its name.
     *
     * @param  string $name Route name without language prefix
     *
     * @return \Illuminate\Routing\Route|null
     */
    public function getByName( $name )
    {
        $prefix = '';

        if( $name !== 'language.change' ){

            $language = App::getLocale();

            if( $language !== Utility::getDefaultLanguageCode() ){
                $prefix = $language . '-';
            }
        }

        return parent::getByName( $prefix . $name );
    }
}