<?php
/**
 * Client credentials grant request management.
 */

namespace App\Libraries\WebServiceRequest;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;

/**
 * This class handles calling API functions through a web service which authorize by client credentials grant.
 * @package App\Libraries\WebServiceRequest
 */
class ClientCredentialsGrantRequest extends BaseRequest
{
    /** Access token properties file */
    private const AccessTokenPropertiesFile = 'client_credentials_access_token.txt';

    /**
     * Get a token type.
     *
     * @return string Token type
     */
    protected function getTokenType()
    {
        return $this->getTokenProperties( 'token_type' );
    }

    /**
     * Get a specific token property.
     *
     * @param string $key Property key
     *
     * @return string Property value
     */
    private function getTokenProperties( string $key )
    {
        try{
            $properties = json_decode( decrypt( Storage::get( self::AccessTokenPropertiesFile ) ), true );
        } catch( FileNotFoundException $exception ) {

            $response = $this->refreshAccessToken();

            if( !isset( $response['error'] ) ){
                $properties = json_decode( decrypt( Storage::get( self::AccessTokenPropertiesFile ) ), true );
            }

        }

        return isset( $properties[ $key ] ) ? $properties[ $key ] : '';
    }

    /**
     * Refresh an access token.
     *
     * @return array Refreshing an access token response
     */
    protected function refreshAccessToken()
    {
        return $this->requestAccessToken( [
                                              'grant_type'    => 'client_credentials',
                                              'client_id'     => env( 'OAUTH_CLIENT_CREDENTIALS_GRANT_CLIENT_ID' ),
                                              'client_secret' => env( 'OAUTH_CLIENT_CREDENTIALS_GRANT_CLIENT_SECRET' ),
                                          ] );
    }

    /**
     * Save access token properties.
     *
     * @param array $properties Access token properties
     */
    protected function saveAccessTokenProperties( array $properties )
    {
        Storage::put( self::AccessTokenPropertiesFile, encrypt( json_encode( $properties, true ) ) );
    }

    /**
     * Get an access token.
     *
     * @return string Token type
     */
    protected function getAccessToken()
    {
        return $this->getTokenProperties( 'access_token' );
    }
}
