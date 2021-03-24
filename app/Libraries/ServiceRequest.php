<?php
/** This is a base class for calling API functions through a GOA web service. */

namespace App\Libraries;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class ServiceRequest
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
    static public function call( string $method, string $suffixUri ,$isImage, array $parameters = [] )
    {
        $res_auth              = self::authentication();
        $parameters['headers'] = self::getRequestHeader( $res_auth );

        $response = self::sendRequest( $method, $suffixUri, $parameters, $isImage );

        if( is_null( $response ) ){

            abort( 500, __( 'exception.not_found_web_service_server' ) );

        } else if( isset( $response['error'] ) && $response['error'] === 'Unauthenticated.' ){

            if( !isset( $response['error'] ) ){
                $parameters['headers'] = self::getRequestHeader( $res_auth );
                $response              = self::sendRequest( $method, $type, $suffixUri, $parameters );
            }

        }

        if( isset( $response['error'] ) ){
            abort( 500, __( 'exception.web_service_error' ) . $response['message'] );
        }

        return $response;
    }

    static protected function getRequestHeader( $res_auth )
    {

        return [
            'Content-Type'  => 'application/x-www-form-urlencoded',
            'Accept'        => 'application/json',
            'Authorization' => 'Bearer ' . $res_auth['data']['access_token'],
        ];
    }

    static public function authentication()
    {
        $client = new Client();
        $client = new Client( [ 'base_uri' => env( 'SERVICE_OAUTH_BASE_URI' ) ] );
        try{
            $parameters['headers'] = [
                'cache-control' => 'no-cache',
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
            ];

            $parameters['body'] = json_encode( [
                'email'    => env( 'SERVICE_OAUTH_USERNAME' ),
                'password' => env( 'SERVICE_OAUTH_PASSWORD' ),
            ]);

            $result = $client->request( 'POST', 'auth/login', $parameters );
            $response = $result->getBody()->getContents();

        } catch( ClientException $clientException ) {
            $response = $clientException->getResponse()->getBody()->getContents();
            $error    = json_decode( $response, true );
            Log::error( $response );
            if( !is_null( $error ) && in_array( $clientException->getCode(), [ 429, 500 ] ) ){
                abort( 500, __( 'exception.web_service_error' ) . $error['message'] );
            }
        } catch( GuzzleException $guzzleException ) {
            $response = $guzzleException->getMessage();
            Log::error( $response );
        }

        return json_decode( $response, true );
    }

    static protected function sendRequest( string $method, string $suffixUri, array $parameters, $isImage )
    {

        $isFile   = array_pull( $parameters, 'isFile', false );
        $tempFile = storage_path( 'temp' );

        if( $isFile ){
            $client             = new Client();
            $parameters['sink'] = $tempFile;
        } else {
            $client = new Client( [ 'base_uri' => self::getServiceURI() ] );
        }

        try{

            $result = $client->request( $method, $suffixUri, $parameters );

            if( $isFile ){
                return [
                    'success' => true,
                    'file'    => $tempFile,
                    'header'  => [ 'Content-Type: ' . $result->getHeader( 'Content-Type' )[0] ],
                ];
            }

            $response = $result->getBody()->getContents();

        } catch( ClientException $clientException ) {

            $response = $clientException->getResponse()->getBody()->getContents();
            $error    = json_decode( $response, true );
            Log::error( $response );
            if( !is_null( $error ) && in_array( $clientException->getCode(), [ 429, 500 ] ) ){
                abort( 500, __( 'exception.web_service_error' ) . $error['message'] );
            }
        } catch( GuzzleException $guzzleException ) {
            $response = $guzzleException->getMessage();
            Log::error( $response );
        }

        if($isImage){
            return base64_encode($response);
        }else{
            return json_decode( $response, true );
        }
    }

    /**
     * @param $type
     *
     * @return mixed|string
     */
    static private function getServiceURI()
    {
        $baseURI = env( 'SERVICE_OAUTH_BASE_URI' );

        return $baseURI;
    }
}