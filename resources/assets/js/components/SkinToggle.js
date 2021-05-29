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

		$(document).ready(function() {
			var skin = localStorage.getItem("skin");
			if(skin === 'light-mode'){
				$( "#skin-toggle" ).prop( "checked", false );
				$( "#skin-toggle-body" ).prop( "checked", false );
				$('body').removeClass('dark-mode');
				$(".sun-image").attr("src","./../images/sun.svg");
				$(".moon-image").attr("src","./../images/moon.svg");
				$( '.slider' ).css( 'background-image', 'url(./../images/slider-text.png)' );
			}else{
				$( "#skin-toggle" ).prop( "checked", true );
				$( "#skin-toggle-body" ).prop( "checked", true );
				$('body').addClass('dark-mode');
				$(".sun-image").attr("src","../../images/day.svg");
				$(".moon-image").attr("src","../../images/night.svg");
				$( '.sun-image' ).css( 'width', '20px' );
				$( '.moon-image' ).css( 'width', '17px' );
				$( '.slider' ).css( 'background-image', 'url(../../images/slider-text-white.png)' );
			}
		});

		$("#skin-toggle").click(function() {
			window.console.log('desktop toggle');
			if($(this).prop("checked") == true){
				$('body').addClass('dark-mode');
				$(".sun-image").attr("src","../../images/day.svg");
				$(".moon-image").attr("src","../../images/night.svg");
				$( '.sun-image' ).css( 'width', '20px' );
				$( '.moon-image' ).css( 'width', '17px' );
				$( '.slider' ).css( 'background-image', 'url(../../images/slider-text-white.png)' );
				localStorage.removeItem("skin");
				localStorage.setItem("skin", "dark-mode");
			}
			else if($(this).prop("checked") == false){
				$('body').removeClass('dark-mode');
				$(".sun-image").attr("src","./../images/sun.svg");
				$(".moon-image").attr("src","./../images/moon.svg");
				$( '.slider' ).css( 'background-image', 'url(./../images/slider-text.png)' );
				localStorage.removeItem("skin");
				localStorage.setItem("skin", "light-mode");
			}
		});

		$("#skin-toggle-body").click(function() {
			window.console.log('mobile toggle');
			if($(this).prop("checked") == true){
				$('body').addClass('dark-mode');
				$(".sun-image").attr("src","/../images/day.svg");
				$(".moon-image").attr("src","/../images/night.svg");
				$( '.sun-image' ).css( 'width', '20px' );
				$( '.moon-image' ).css( 'width', '17px' );
				$( '.slider' ).css( 'background-image', 'url(/../images/slider-text-white.png)' );
				localStorage.removeItem("skin");
				localStorage.setItem("skin", "dark-mode");
			}
			else if($(this).prop("checked") == false){
				$('body').removeClass('dark-mode');
				$(".sun-image").attr("src","/../images/sun.svg");
				$(".moon-image").attr("src","/../images/moon.svg");
				$( '.slider' ).css( 'background-image', 'url(/../images/slider-text.png)' );
				localStorage.removeItem("skin");
				localStorage.setItem("skin", "light-mode");
			}
		});

	}

	return {
		initialize: initialize,
	};
})( jQuery );
