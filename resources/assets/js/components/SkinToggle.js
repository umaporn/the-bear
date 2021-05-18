/**
 * @namespace
 * @desc Handles SkinToggle.
 */
const SkinToggle = (function(){
	/**
	 * @memberOf Menu
	 * @access public
	 * @desc Initialize Menu module.
	 */
	function initialize(){
		$("#skin-toggle").click(function() {
			window.console.log('desktop toggle');
			if($(this).prop("checked") == true){
				$('body').addClass('dark-mode');
				$(".sun-image").attr("src","../../images/day.svg");
				$(".moon-image").attr("src","../../images/night.svg");
				$( '.sun-image' ).css( 'width', '25px' );
				$( '.moon-image' ).css( 'width', '25px' );
			}
			else if($(this).prop("checked") == false){
				$('body').removeClass('dark-mode');
				$(".sun-image").attr("src","../../images/sun.svg");
				$(".moon-image").attr("src","../../images/moon.svg");
			}
		});

		$("#skin-toggle-body").click(function() {
			window.console.log('mobile toggle');
			if($(this).prop("checked") == true){
				$('body').addClass('dark-mode');
				$(".sun-image").attr("src","../../images/day.svg");
				$(".moon-image").attr("src","../../images/night.svg");
				$( '.sun-image' ).css( 'width', '25px' );
				$( '.moon-image' ).css( 'width', '25px' );
			}
			else if($(this).prop("checked") == false){
				$('body').removeClass('dark-mode');
				$(".sun-image").attr("src","../../images/sun.svg");
				$(".moon-image").attr("src","../../images/moon.svg");
			}
		});

	}

	return {
		initialize: initialize,
	};
})( jQuery );
