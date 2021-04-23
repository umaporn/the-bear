const mix = require( 'laravel-mix' );

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js( [
	        'resources/assets/js/app.js',
        ], 'public/js' )
   .sass( 'resources/assets/sass/app.scss', 'public/css' )
   .babel( [
               'resources/assets/js/components/Confirmation.js',
               'resources/assets/js/components/Form.js',
               'resources/assets/js/components/Menu.js',
               'resources/assets/js/components/Search.js',
               'resources/assets/js/components/Translator.js',
               'resources/assets/js/components/Utility.js',
               'resources/assets/js/components/PasswordToggle.js',
               'resources/assets/js/components/Footer.js',
               'resources/assets/js/components/FileUpload.js',
               'resources/assets/js/components/SkinToggle.js',
               'resources/assets/js/all.js',
           ], 'public/js/all.js' )
   .version();
