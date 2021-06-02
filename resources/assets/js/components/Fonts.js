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

		$(document).ready(function() {
			var fontSize = localStorage.getItem("fontSize");
			var fontRange = localStorage.getItem("fontRange");
			$( 'body p' ).css( 'font-size', fontSize + 'px' );
			$( 'body a' ).css( 'font-size', fontSize + 'px' );
			$( '#font-range' ).val(fontRange);
			//rest of code here to set the font size based on fontSize value
		});

		$( 'body #font-range' ).on( 'input', function(){
			localStorage.removeItem("fontRange");
			localStorage.setItem("fontRange", $(this).val());
	  	    if($(this).val()==1){
		        $( 'body p' ).css( 'font-size', '16px' );
		        $( 'body a' ).css( 'font-size', '16px' );
		        localStorage.removeItem("fontSize");
		        localStorage.setItem("fontSize", 16);
	        }
			if($(this).val()==2){
				$( 'body p' ).css( 'font-size', '21px' );
				$( 'body a' ).css( 'font-size', '21px' );
				localStorage.removeItem("fontSize");
				localStorage.setItem("fontSize", 21);
			}
			if($(this).val()==3){
				$( 'body p' ).css( 'font-size', '26px' );
				$( 'body a' ).css( 'font-size', '26px' );
				localStorage.removeItem("fontSize");
				localStorage.setItem("fontSize", 26);
			}
		} );

		$( 'body #font-range-mobile' ).on( 'input', function(){
			if($(this).val()==1){
				$( 'body p' ).css( 'font-size', '16px' );
				$( 'body a' ).css( 'font-size', '16px' );
				localStorage.removeItem("fontSize");
				localStorage.setItem("fontSize", 16);
			}
			if($(this).val()==2){
				$( 'body p' ).css( 'font-size', '21px' );
				$( 'body a' ).css( 'font-size', '21px' );
				localStorage.removeItem("fontSize");
				localStorage.setItem("fontSize", 21);
			}
			if($(this).val()==3){
				$( 'body p' ).css( 'font-size', '26px' );
				$( 'body a' ).css( 'font-size', '26px' );
				localStorage.removeItem("fontSize");
				localStorage.setItem("fontSize", 26);
			}
		} );

	}

	return {
		initialize: initialize,
	};
})( jQuery );
