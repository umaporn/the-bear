/**
 * @desc Spinner selector
 * @const {jQuery}
 */
const SpinnerSelector = $( '#spinner, #spinner-popup' );

Translator.initialize();

$.ajaxSetup( {
                 headers: {
                     'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' ),
                 },
             } );

$( document )
    .ajaxStart( function(){
        SpinnerSelector.show();
    } )
    .ajaxComplete( function(){
        SpinnerSelector.hide();
    } )
    .ready( function(){
        /** Initialize all JavaScript modules. */
        Menu.initialize();
        Search.initialize();
        Confirmation.initialize();
        Form.initialize();
        Footer.initialize();
        PasswordToggle.initialize();
    } );