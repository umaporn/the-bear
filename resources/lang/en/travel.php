<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Travel Page Language Lines
    |--------------------------------------------------------------------------
    */

    'page_link' => [
        'index'  => 'The bear travel',
        'detail' => 'The bear travel',
    ],

    'page_title' => [
        'index'  => 'The bear travel',
        'detail' => 'The bear travel | :travel_title',
    ],

    'page_description' => [
        'index'  => 'The bear travel',
        'detail' => 'The bear travel :travel_description',
    ],

    'page_keyword' => [
        'index'  => 'The bear travel',
        'detail' => 'The bear travel :travel_keyword',
    ],

    'og_title' => [
        'index'  => 'The bear travel',
        'detail' => 'The bear travel :travel_title',
    ],

    'og_description' => [
        'index'  => 'The bear travel',
        'detail' => 'The bear travel :travel_description',
    ],

    'og_keyword' => [
        'index'  => 'The bear travel',
        'detail' => 'The bear travel :travel_keyword',
    ],

    'og_url' => [
        'index'  => route( 'travel.index' ),
        'detail' => route( 'travel.detail', [ 'slug' => ':slug', 'id' => ':travel_id' ]),
    ],

];
