/**
 * @namespace
 * @desc JavaScript translator
 */
const Translator = (function(){

    /**
     * @memberOf Translator
     * @access private
     * @desc JavaScript Translator
     * @constant {Object}
     */
    const JSTranslator = JSTranslate.i18n( {
                                               language:        Laravel.languageCodes,
                                               defaultLanguage: Laravel.defaultLanguage,
                                           } );

    /**
     * @memberOf Translator
     * @access public
     * @desc Initialize JavaScript translator.
     */
    function initialize(){

        $.holdReady( true );

        let jsonFiles    = [],
            errorMessage = 'Error! Failed to load some translation files, please contact the system administrator.';

        Laravel.languageCodes.forEach( function( languageCode ){
            jsonFiles.push( $.getJSON( '/languages/' + languageCode + '.json', { timestamp: Date.now() } ) );
        } );

        $.when.apply( this, jsonFiles )
         .then(
             function(){

                 for( let index = 0; index < arguments.length; index++ ){
                     JSTranslator.add( {
                                           language: Laravel.languageCodes[index],
                                           data:     arguments[index][0],
                                       } );
                 }

                 JSTranslator.useLanguage( Laravel.currentLanguage );
             },
             function(){
                 Utility.displayErrorMessageBox( errorMessage );
             },
         ).always( function(){
            $.holdReady( false );
        } );
    }

    /**
     * @memberOf Translator
     * @access public
     * @desc Translate text with a specific key.
     * @param {String} key - Translation key
     * @return {String} Translated text
     */
    function translate( key ){
        return JSTranslator.translate( key );
    }

    return {
        initialize: initialize,
        translate:  translate,
    };

})( jQuery );