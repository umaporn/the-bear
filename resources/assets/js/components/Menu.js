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

				$( '.dropdown' ).css('display', 'block');
				// $( 'body .dropdown' ).transition( {
				// 	                             y:        '0px',
				// 	                             duration: 500,
				//                              } );

			}
		} );
		$( '.parent-mobile' ).click( function(){

			if( $( '.dropdown-mobile' ).is( ':visible' ) ){
				$( '.dropdown-mobile' ).hide();
			}else{

				$( '.dropdown-mobile' ).css('display', 'block');
				/*$( '.dropdown-mobile' ).transition( {
					                             y:        '0px',
					                             duration: 500,
					                             easing:   'in',
				                             } );*/

			}
		} );
	}

	return {
		initialize: initialize,
	};
})( jQuery );
