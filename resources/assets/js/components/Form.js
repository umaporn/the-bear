/**
 * @namespace
 * @desc Handles form management.
 */
const Form = (function(){
	const /**
	       * @memberOf Form
	       * @access private
	       * @desc Submission form
	       * @const {jQuery}
	       */
	      SubmissionForm               = $( '.submission-form' ),
	      /**
	       * @memberOf Form
	       * @access private
	       * @desc reCAPTCHA form
	       * @const {jQuery}
	       */
	      RecaptchaForm                = $( '.recaptcha-form' ),
	      /**
	       * @memberOf Form
	       * @access private
	       * @desc Deletion confirmation selector
	       * @const {string}
	       */
	      DeletionConfirmationSelector = '.deletion',
	      /**
	       * @memberOf FormSubmitElement
	       * @access private
	       * @desc Button to submit form
	       * @constant {jQuery}
	       */
	      FormSubmitElement            = $( '.form-submit' );

	/**
	 * @memberOf Form
	 * @access public
	 * @desc Initialize Form module.
	 */
	function initialize(){

		$( '#join-form' ).click( function( event ){

			window.console.log('test');
			//Utility.submitForm( $( this ).closest( "form" ) );
		} );

		SubmissionForm.submit( function( event ){
			event.preventDefault();

			Utility.submitForm( $( this ) );
		} );

		RecaptchaForm.submit( function( event ){
			event.preventDefault();

			_submitEvent = () => {
				Utility.submitForm( $( this ) );
			};
		} );

		FormSubmitElement.on( 'click', function( event ){
			event.preventDefault();

			$( this )
				.closest( 'form' )
				.submit();
		} );

		Search.SearchForm.submit( function( event ){
			event.preventDefault();
			window.console.log('submit');

			Search.submitForm( $( this ) );
		} );

		Search.ResultDiv.on( 'submit', DeletionConfirmationSelector, function( event ){
			event.preventDefault();
			Confirmation.confirmToDelete( $( this ), Search.SearchForm );
		} );

		$( '.deletion' ).submit( function( event ){
			event.preventDefault();
			Confirmation.confirmToDelete( $( this ), Search.SearchForm );
		} );

	}

	return {
		initialize: initialize,
	};
})( jQuery );
