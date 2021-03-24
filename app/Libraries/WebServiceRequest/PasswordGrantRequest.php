<?php
/**
 * Password grant request management.
 */

namespace App\Libraries\WebServiceRequest;

/**
 * This class handles calling API functions through a web service which authorize by password grant.
 * @package App\Libraries\WebServiceRequest
 */
class PasswordGrantRequest extends BaseRequest
{
    /**
     * Attempt to log the user into the application.
     *
     * @param array $credentials Credentials
     *
     * @return bool Success status
     */
    public function attemptLogin( array $credentials )
    {
        $response = $this->requestAccessToken( [
                                                   'grant_type'    => 'password',
                                                   'client_id'     => env( 'OAUTH_PASSWORD_GRANT_CLIENT_ID' ),
                                                   'client_secret' => env( 'OAUTH_PASSWORD_GRANT_CLIENT_SECRET' ),
                                                   'username'      => $credentials['email'],
                                                   'password'      => $credentials['password'],
                                               ] );
        $success  = isset( $response['error'] ) ? false : true;

        if( $success ){
            session( [
                         'email'    => $credentials['email'],
                         'password' => encrypt( $credentials['password'] ),
                     ] );
        }

        return $success;
    }

    /**
     * Refresh an access token.
     *
     * @return array Refreshing an access token response
     */
    protected function refreshAccessToken()
    {
        return $this->requestAccessToken( [
                                              'grant_type'    => 'refresh_token',
                                              'client_id'     => env( 'OAUTH_PASSWORD_GRANT_CLIENT_ID' ),
                                              'client_secret' => env( 'OAUTH_PASSWORD_GRANT_CLIENT_SECRET' ),
                                              'refresh_token' => $this->getRefreshToken(),
                                          ] );
    }

    /**
     * Get an access token.
     *
     * @return string Token type
     */
    private function getRefreshToken()
    {
        return session( 'accessTokenProperties' )['refresh_token'] ?? '';
    }

    /**
     * Get an access token.
     *
     * @return string Token type
     */
    public function getAccessToken()
    {
        return session( 'accessTokenProperties' )['access_token'] ?? '';
    }

    /**
     * Save access token properties.
     *
     * @param array $properties Access token properties
     */
    protected function saveAccessTokenProperties( array $properties )
    {
        session( [ 'accessTokenProperties' => $properties ] );
    }

    /**
     * Get a token type.
     *
     * @return string Token type
     */
    protected function getTokenType()
    {
        return session( 'accessTokenProperties' )['token_type'] ?? '';
    }
}
