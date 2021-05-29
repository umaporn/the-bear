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
			$( 'p' ).css( 'font-size', fontSize + 'px' );
			$( 'a' ).css( 'font-size', fontSize + 'px' );
			$( '#font-range' ).val(fontRange);
			//rest of code here to set the font size based on fontSize value
		});

		$( '#font-range' ).on( 'input', function(){
	  	    window.console.log($(this).val());
			localStorage.removeItem("fontRange");
			localStorage.setItem("fontRange", $(this).val());
	  	    if($(this).val()==1){
		        $( 'p' ).css( 'font-size', '16px' );
		        $( 'a' ).css( 'font-size', '16px' );
		        localStorage.removeItem("fontSize");
		        localStorage.setItem("fontSize", 16);
	        }
			if($(this).val()==2){
				$( 'p' ).css( 'font-size', '21px' );
				$( 'a' ).css( 'font-size', '21px' );
				localStorage.removeItem("fontSize");
				localStorage.setItem("fontSize", 21);
			}
			if($(this).val()==3){
				$( 'p' ).css( 'font-size', '26px' );
				$( 'a' ).css( 'font-size', '26px' );
				localStorage.removeItem("fontSize");
				localStorage.setItem("fontSize", 26);
			}
		} );

		$( '#font-range-mobile' ).on( 'input', function(){
			window.console.log($(this).val());
			if($(this).val()==1){
				$( 'p' ).css( 'font-size', '16px' );
				$( 'a' ).css( 'font-size', '16px' );
				localStorage.removeItem("fontSize");
				localStorage.setItem("fontSize", 16);
			}
			if($(this).val()==2){
				$( 'p' ).css( 'font-size', '21px' );
				$( 'a' ).css( 'font-size', '21px' );
				localStorage.removeItem("fontSize");
				localStorage.setItem("fontSize", 21);
			}
			if($(this).val()==3){
				$( 'p' ).css( 'font-size', '26px' );
				$( 'a' ).css( 'font-size', '26px' );
				localStorage.removeItem("fontSize");
				localStorage.setItem("fontSize", 26);
			}
		} );

	}

	return {
		initialize: initialize,
	};
})( jQuery );
