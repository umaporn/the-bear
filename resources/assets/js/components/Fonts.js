/**
 * @namespace
 * @desc Handles font management.
 */
const Fonts = (function(){
	/**
	 * @memberOf Fonts
	 * @access public
	 * @desc Initialize Fonts module.
	 */
	function initialize(){

		$( '#font-range' ).on( 'input', function(){
	  	    window.console.log($(this).val());
	  	    if($(this).val()==1){
		        $( 'p' ).css( 'font-size', '16px' );
	        }
			if($(this).val()==2){
				$( 'p' ).css( 'font-size', '21px' );
			}
			if($(this).val()==3){
				$( 'p' ).css( 'font-size', '26px' );
			}
		} );

		$( '#font-range-mobile' ).on( 'input', function(){
			window.console.log($(this).val());
			if($(this).val()==1){
				$( 'p' ).css( 'font-size', '16px' );
			}
			if($(this).val()==2){
				$( 'p' ).css( 'font-size', '21px' );
			}
			if($(this).val()==3){
				$( 'p' ).css( 'font-size', '26px' );
			}
		} );

	}

	return {
		initialize: initialize,
	};
})( jQuery );
