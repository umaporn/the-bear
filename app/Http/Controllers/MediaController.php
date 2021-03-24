<?php
/**
 * Media Controller
 */

namespace App\Http\Controllers;

use App\Support\Facades\ClientGrant;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * This class handles requesting a media from a web service request.
 * @package App\Http\Controllers
 */
class MediaController extends Controller
{
    /**
     * Get a file from a web service request.
     *
     * @param string $url Encrypted URL
     *
     * @return BinaryFileResponse File
     */
    public function getFile( string $url )
    {
        $response = ClientGrant::call( 'GET', decrypt( $url ), [ 'isFile' => true ] );

        return response( $response['content'] )->header( 'Content-Type', $response['contentType'] );
    }
}