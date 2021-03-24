<?php
/*
    |--------------------------------------------------------------------------
    | Social media links
    |--------------------------------------------------------------------------
    |
    | Configuration of dtgo social media links
    |
    */
return [

    'authen' => [
        'facebook' => env( 'AUTH_OREID_LOGIN' ) . '/facebook',
        'twitter'  => env( 'AUTH_OREID_LOGIN' ) . '/twitter',
        'google'   => env( 'AUTH_OREID_LOGIN' ) . '/google',
    ],
];