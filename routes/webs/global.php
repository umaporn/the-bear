<?php

use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

/**
 * Global routes
 */
function globalRoutes()
{
    Route::get( 'language/{languageCode}', 'LanguageController@changeLanguage' )->name( 'language.change' );
    Route::get( 'file/{url}', 'MediaController@getFile' )->name( 'getFile' );

    Route::get( 'sitemap', 'SitemapController@index' )->name( 'sitemap.index' );
    Route::get( 'sitemap.xml', 'SitemapController@xml' )->name( 'sitemap.xml' );

    Route::group( [ 'middleware' => 'auth' ], function(){
        //Route::get( '/', 'HomeController@index' )->name( 'home.index' );
        Route::post( 'logout', 'Auth\LoginController@logout' )->name( 'logout' );
    } );

    Route::middleware( 'guest' )->group( function(){

        Route::get( 'group', 'GroupController@index' )->name( 'group.index' );
        Route::get( 'group/{slug}/{id}', 'GroupController@detail' )->name( 'group.detail' );

        Route::get( 'travel', 'TravelController@index' )->name( 'travel.index' );
        Route::get( 'travel/{id}/{slug}', 'TravelController@detail' )->name( 'travel.detail' );

        // Authentication
        Route::get( 'login', 'Auth\LoginController@showLoginForm' )->name( 'login' );
        Route::post( 'login', 'Auth\LoginController@login' )->name( 'submitLogin' );

        // Registration
        Route::get( 'signup', 'Auth\RegisterController@showRegistrationForm' )->name( 'register' );
        Route::post( 'signup', 'Auth\RegisterController@register' )->name( 'submitRegister' );

        // Password Reset
        Route::get( 'password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm' )->name( 'password.request' );
        Route::post( 'password/email', 'Auth\ForgotPasswordController@sendResetPasswordLink' )->name( 'password.email' );
        Route::get( 'password/reset/{token}', 'Auth\ResetPasswordController@showResetForm' )->name( 'password.reset' );
        Route::post( 'password/reset', 'Auth\ResetPasswordController@reset' )->name( 'password.change' );
    } );
}
