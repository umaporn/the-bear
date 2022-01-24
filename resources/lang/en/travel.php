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
        'detail' => ':travel_title | The bear travel',
        'menu'   => 'The bear travel | :menu_title',
    ],

    'page_description' => [
        'index'  => 'The bear travel',
        'detail' => ':travel_description',
        'menu'   => 'The bear travel | :menu_title',
    ],

    'page_keyword' => [
        'index'  => 'The bear travel',
        'detail' => 'The bear travel :travel_keyword',
        'menu'   => 'The bear travel | :menu_title',
    ],

    'og_title' => [
        'index'  => 'The bear travel',
        'detail' => ':travel_title | The bear travel',
        'menu'   => 'The bear travel | :menu_title',
    ],

    'og_description' => [
        'index'  => 'The bear travel',
        'detail' => ':travel_description',
        'menu'   => 'The bear travel | :menu_title',
    ],

    'og_keyword' => [
        'index'  => 'The bear travel',
        'detail' => ':travel_keyword',
        'menu'   => 'The bear travel | :menu_title',
    ],

    'og_url' => [
        'index'  => route( 'travel.index' ),
        'detail' => route( 'travel.detail', [ 'slug' => ':slug', 'id' => ':travel_id' ] ),
        'menu'   => route( 'travel.menu', [ 'slug' => ':slug', 'menuID' => ':menu_id' ] ),
    ],

];
