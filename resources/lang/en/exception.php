<?php

$endingSentence = ', please contact the system administrator.';

return [

    /*
    |--------------------------------------------------------------------------
    | Exception Language Lines
    |--------------------------------------------------------------------------
    */

    'query'                        => 'Found query exception' . $endingSentence,
    'database_connection'          => 'Could not access to the database' . $endingSentence,
    'mail_server_connection'       => 'Could not access to the mail server' . $endingSentence,
    'web_service_error'            => 'Found some web service request errors: ',
    'not_found_web_service_server' => 'The web service server has some problems' . $endingSentence,
    'throttle'                     => 'Too many attempts. Please try again in few minutes.',
];
