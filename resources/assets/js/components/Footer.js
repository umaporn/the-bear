/**
 * @namespace
 * @desc Redirect to our website with option in footer.
 */

const Footer = (function(){
	/**
	 * @memberOf Footer
	 * @desc Initialize Footer module.
	 * @access public
	 * @return {void}
	 */
	function initialize(){
		if( $( '.redirect_to' ).length ){
			$( '.redirect_to' ).change( function(){
				if( $( this ).attr( 'target' ) === '_blank' ){
					window.open( $( this ).val(), '_blank' );
				} else {
					window.location = $( this ).val();
				}
			} );
		}

		$( window ).resize( function(){
			if( $( window ).width() <= 768 ){
				$( '.menu-two-title' ).click( function(){
					$( '.menu-one' ).hide();
					$( '.menu-two' ).show();
					$( '.menu-two-title' ).addClass( 'active' );
					$( '.menu-one-title' ).removeClass( 'active' );
				} );

				$( '.menu-one-title' ).click( function(){
					$( '.menu-two' ).hide();
					$( '.menu-one' ).show();
					$( '.menu-one-title' ).addClass( 'active' );
					$( '.menu-two-title' ).removeClass( 'active' );
				} );
			}
		} );

		$( document ).on( 'click', '.pick-flavor', function(){
			var url = $( this ).attr( 'data-url' );
			window.location = url;
		} );
	}

	return {
		initialize: initialize,
	};
})( jQuery );
