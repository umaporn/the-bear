<?php
/** This is a base class for calling API functions through a web service. */

namespace App\Libraries\WebServiceRequest;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

/**
 * This abstract class handles calling API functions through a web service.
 * @package App\Libraries\WebServiceRequest
 */
abstract class BaseRequest
{
    /**
     * Call an API function through a web service request.
     *
     * @param string $method     HTTP method
     * @param string $suffixUri  Suffix URI
     * @param array  $parameters Parameters
     *
     * @return array API response
     */
    public function call( string $method, string $suffixUri, array $parameters = [] )
    {
        $parameters['headers'] = $this->getRequestHeader();
        $response              = $this->sendRequest( $method, $suffixUri, $parameters );

        if( is_null( $response ) ){
            abort( 500, __( 'exception.not_found_web_service_server' ) );
        }

        return $response;
    }

    /**
     * Get the request header.
     *
     * @return array Request header
     */
    protected function getRequestHeader()
    {
        return [
            'Accept'        => 'application/json',
            'Authorization' => $this->getTokenType() . ' ' . $this->getAccessToken(),
        ];
    }

    /**
     * Get a token type.
     *
     * @return string Token type
     */
    abstract protected function getTokenType();

    /**
     * Get an access token.
     *
     * @return string Token type
     */
    abstract protected function getAccessToken();

    /**
     * Send a web service request.
     *
     * @param string $method     HTTP method
     * @param string $suffixUri  Suffix URI
     * @param array  $parameters Parameters
     *
     * @return array Web service response
     */
    protected function sendRequest( string $method, string $suffixUri, array $parameters )
    {
        $isFile = array_pull( $parameters, 'isFile', false );

        if( $isFile ){
            $client = new Client();
        } else {
            $client = new Client( [ 'base_uri' => env( 'OAUTH_BASE_URI' ) ] );
        }

        try{

            $result = $client->request( $method, $suffixUri, $parameters );

            if( $isFile ){
                return [
                    'success'     => true,
                    'content'     => $result->getBody()->getContents(),
                    'contentType' => $result->getHeader( 'Content-Type' )[0],
                ];
            }

            $response = $result->getBody()->getContents();

        } catch( ClientException $clientException ) {

            $response = $clientException->getResponse()->getBody()->getContents();
            $error    = json_decode( $response, true );

            Log::error( $response );

            switch( $clientException->getCode() ){
                case 401:
                    if( $suffixUri === '/oauth/token' ){
                        if( $error['error'] !== 'invalid_credentials' ){
                            abort( $clientException->getCode(), __( 'exception.web_service_error' ) . $error['message'] ?? $error['error'] );
                        }
                    } else {
                        $this->refreshAccessToken();
                        $parameters['headers'] = $this->getRequestHeader();

                        return $this->sendRequest( $method, $suffixUri, $parameters );
                    }
                    break;
                case 422:
                    break;
                default:
                    abort( $clientException->getCode(), __( 'exception.web_service_error' ) . $error['message'] );
                    break;
            }

        } catch( GuzzleException $guzzleException ) {
            $response = $guzzleException->getMessage();
            Log::error( $response );
        }

        return json_decode( $response, true );
    }

    /**
     * Refresh an access token.
     */
    abstract protected function refreshAccessToken();

    /**
     * Request the access token.
     *
     * @param array $parameters Form parameters
     *
     * @return array requesting an access token response
     */
    protected function requestAccessToken( array $parameters )
    {
        $response = $this->sendRequest( 'POST', '/oauth/token', [
            'form_params' => $parameters,
        ] );

        if( is_null( $response ) ){
            abort( 500, __( 'exception.not_found_web_service_server' ) );
        } else {
            $this->saveAccessTokenProperties( $response );
        }

        return $response;
    }

    /**
     * Save access token properties.
     *
     * @param array $properties Access token properties
     */
    abstract protected function saveAccessTokenProperties( array $properties );
}
