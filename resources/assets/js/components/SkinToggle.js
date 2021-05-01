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
			if($(this).prop("checked") == true){
				$('body').addClass('dark-mode');
			}
			else if($(this).prop("checked") == false){
				$('body').removeClass('dark-mode');
			}
		});

		$("#skin-toggle-body").click(function() {
			if($(this).prop("checked") == true){
				$('body').addClass('dark-mode');
			}
			else if($(this).prop("checked") == false){
				$('body').removeClass('dark-mode');
			}
		});
	}

	return {
		initialize: initialize,
	};
})( jQuery );
