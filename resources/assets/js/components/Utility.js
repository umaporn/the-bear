/**
 * @namespace
 * @desc Handles all utility functions.
 */
const Utility = (function(){

    const
        /**
         * @memberOf Utility
         * @access public
         * @desc Result box
         * @constant {jQuery}
         */
        ResultBoxSelector   = $( '#result-box' ),
        /**
         * @memberOf Utility
         * @access private
         * @desc Result title
         * @constant {jQuery}
         */
        ResultTitleSelector = $( '#result-title' ),
        /**
         * @memberOf Utility
         * @access private
         * @desc Result text
         * @constant {jQuery}
         */
        ResultTextSelector  = $( '#result-text' );

    /**
     * @memberOf Utility
     * @access private
     * @desc Display a result message box.
     * @param {String} message - Result message
     * @param {Boolean} isError - Error flag ( true = error, false = not error )
     */
    function displayMessageBox( message, isError ){

        clearErrors();

        ResultTextSelector.html( message );

        if( ResultTextSelector.hasClass( 'alert' ) ){
            if( !isError ){
                ResultTitleSelector.html( Translator.translate( 'utility.result.success' ) );
                ResultTextSelector.removeClass( 'alert' );
            }
        } else {
            if( isError ){
                ResultTitleSelector.html( Translator.translate( 'utility.result.error' ) );
                ResultTextSelector.addClass( 'alert' );
            }
        }

        ResultBoxSelector.modal();

    }

    /**
     * @memberOf Utility
     * @access public
     * @desc Display a success message box.
     * @param {String} successMessage - Success message
     */
    function displaySuccessMessageBox( successMessage ){
        displayMessageBox( successMessage, false );
    }

    /**
     * @memberOf Utility
     * @access public
     * @desc Display an error message box.
     * @param {String} errorMessage - Error message
     */
    function displayErrorMessageBox( errorMessage ){
        displayMessageBox( errorMessage, true );
    }

    /**
     * @memberOf Utility
     * @access public
     * @desc Clear all errors.
     */
    function clearErrors(){
        $( ':input' ).removeClass( 'error' );
        $( '.alert.help-text' ).addClass( 'd-none' );
    }

    /**
     * @memberOf Utility
     * @access public
     * @desc Display invalid inputs.
     * @param {JSON} error - Input error list
     */
    function displayInvalidInputs( error ){

        clearErrors();

	    if( error.hasOwnProperty( 'errors' ) ){
		    let i = 0;
		    for( let name in error['errors'] ){
			    let errorMessage = error['errors'][name],
			        id           = /^[^.]+\.\d+$/.test( name ) ? name.replace( '.', '' ) : $( '[name="' + name + '"]' ).attr( 'id' ),
			        errorText    = typeof (errorMessage) === 'object' ? errorMessage[0] : errorMessage;

			    if( id ){
				    $( '#' + id ).addClass( 'error' );
				    $( '#' + id + '-help-text' ).text( errorText ).removeClass( 'd-none' );

				    if( name === 'budget_type' || name === 'milerate_subtype' || name === 'taxi_subtype' || name === 'biketaxi_subtype' ){
					    $( '#' + name ).addClass( 'error' );
					    $( '#' + name + '-help-text' ).text( errorText ).removeClass( 'd-none' );
				    }
				    if( $( '#toggle-error-message' ).length ){

					    if( i === 0 ){
						    if( name === 'milerate_subtype' || name === 'taxi_subtype' || name === 'biketaxi_subtype' ){

							    $( 'html, body' ).animate( {
								                               scrollTop: $( '#' + name + '-help-text' ).offset().top,
							                               }, 1000 );
						    } else {
							    $( 'html, body' ).animate( {
								                               scrollTop: $( '#' + id ).offset().top,
							                               }, 1000 );
						    }

					    }
				    }
			    } else {
				    let parentId = $( '[name="' + name + '[]"]' ).parents( '.checkbox-group' ).attr( 'id' );
				    $( '#' + parentId + '-help-text' ).text( errorText ).removeClass( 'd-none' );
			    }
			    i++;
		    }

	    }

    }

    /**
     * @memberOf Utility
     * @access public
     * @desc Display an unknown error.
     * @param {XMLHttpRequest} jqXHR - jQuery XMLHttpRequest object
     * @param {String} url - The URL that occurs the error
     */
    function displayUnknownError( jqXHR, url ){

        clearErrors();

        let errorText = '<h5>' + Translator.translate( 'utility.calling_system_administrator' ) + '</h5>';
        errorText += '<strong>' + Translator.translate( 'utility.error_url' ) + '</strong> ' + url + '<br>';
        errorText += '<strong>' + Translator.translate( 'utility.error_status_code' ) + '</strong> ' + jqXHR.status + '<br>';
        errorText += '<strong>' + Translator.translate( 'utility.error_status_text' ) + '</strong> ' + jqXHR.statusText + '<br>';

        displayErrorMessageBox( errorText );

    }

    /**
     * @memberOf Utility
     * @access public
     * @desc Display an error message box when the data type is not JSON.
     * @param {XMLHttpRequest} jqXHR - jQuery XMLHttpRequest object
     * @param {String} url - The URL that occurs the error
     */
    function displayJsonResponseError( jqXHR, url ){

        jqXHR.statusText = Translator.translate( 'utility.json_response_error' );

        displayUnknownError( jqXHR, url );

    }

    /**
     * @memberOf Utility
     * @access public
     * @desc Take a submitting action which only accepts json data type.
     * @param {jQuery} form - Form
     * @param {XMLHttpRequest} jqXHR - jQuery XMLHttpRequest object
     * > If jqXHR.status is not 422 or 429 then the jqXHR.responseJSON format must have the following keys below.
     *
     * Key | Explanation
     * - | -
     * **success** {Boolean} | It is a success status which it can be true or false.
     * **message** {String} | It is a response message which it can be an error message or a success message. *This is an optional key for a success case.*
     * **redirectedUrl** {String} | It is a redirected URL which the browser will be redirected to if success status is true. *This is an optional key.*
     *
     * **Note:** jqXHR.status is HTTP status code.
     */
    function takeSubmitAction( form, jqXHR ){

        switch( jqXHR.status ){
            case 422:
            case 429:
                displayInvalidInputs( jqXHR.responseJSON );
                break;
            case 200:
                if( jqXHR.hasOwnProperty( 'responseJSON' ) ){

                    let result = jqXHR.responseJSON;

                    if( result.success === true ){

                        if( result.hasOwnProperty( 'message' ) ){

                            ResultBoxSelector.on( 'hidden.bs.modal', function(){
                                if( result.redirectedUrl ){
                                    location.href = result.redirectedUrl;
                                } else {
                                    form.trigger( 'reset' );
                                }
                            } );

                            displaySuccessMessageBox( result.message );

                        } else if( result.redirectedUrl ){
                            location.href = result.redirectedUrl;
                        }

                    } else {
                        displayErrorMessageBox( result.message );
                    }

                } else {
                    displayJsonResponseError( jqXHR, form.attr( 'action' ) );
                }
                break;
            default:
                if( jqXHR.hasOwnProperty( 'responseJSON' ) && jqXHR.responseJSON.hasOwnProperty( 'message' ) ){
                    displayErrorMessageBox( jqXHR.responseJSON.message );
                } else {
                    displayUnknownError( jqXHR, form.attr( 'action' ) );
                }
                break;
        }

    }

    /**
     * @memberOf Utility
     * @access private
     * @desc Run a callback function.
     * @param {jQuery} form - Form
     * @param {XMLHttpRequest} jqXHR - jQuery XMLHttpRequest object
     * @param {function} [callbackFunction] - Callback function
     */
    function runCallbackFunction( form, jqXHR, callbackFunction ){

        if( typeof(callbackFunction) === 'function' ){
            callbackFunction.apply( this, [form, jqXHR] );
        } else {
            takeSubmitAction( form, jqXHR );
        }

    }

    /**
     * @memberOf Utility
     * @access private
     * @desc Get form data.
     * @param {jQuery} form - Form
     * @return {Array|Object} Form data
     */
    function getFormData( form ){

        return (form.attr( 'method' ) === 'GET') ? form.serialize() : new FormData( form.get( 0 ) );

    }

    /**
     * @memberOf Utility
     * @access public
     * @desc Submit a form and take an action.
     * @param {jQuery} form - Form
     * @param {function} [callbackFunction] - Callback function
     */
    function submitForm( form, callbackFunction ){
        $.ajax( {
                    url:         form.attr( 'action' ),
                    method:      form.attr( 'method' ),
                    data:        getFormData( form ),
                    cache:       false,
                    contentType: false,
                    processData: false,
                    success:     function( result, statusText, jqXHR ){
                        runCallbackFunction( form, jqXHR, callbackFunction );
                    },
                    error:       function( jqXHR ){
                        runCallbackFunction( form, jqXHR, callbackFunction );
                    },
                } );
    }

    return {
        submitForm:               submitForm,
        displaySuccessMessageBox: displaySuccessMessageBox,
        displayErrorMessageBox:   displayErrorMessageBox,
        displayInvalidInputs:     displayInvalidInputs,
        displayUnknownError:      displayUnknownError,
        displayJsonResponseError: displayJsonResponseError,
        clearErrors:              clearErrors,
        ResultBoxSelector:        ResultBoxSelector,
        takeSubmitAction:         takeSubmitAction,
	    runCallbackFunction:      runCallbackFunction,
	    getFormData:              getFormData,
    };

})( jQuery );
