/**
 * @namespace
 * @desc Handles menu management.
 */
const Menu = (function(){
	/**
	 * @memberOf Menu
	 * @access public
	 * @desc Initialize Menu module.
	 */
	function initialize(){
		$( '.parent' ).click( function(){

			if( $( '.dropdown' ).is( ':visible' ) ){
				$( '.dropdown' ).hide();
			}else{
				$( '.dropdown' ).show();
				$( '.dropdown' ).transition( {
					                             y:        '0px',
					                             duration: 500,
					                             easing:   'in',
				                             } );
			}
		} );

	}

	return {
		initialize: initialize,
	};
})( jQuery );
