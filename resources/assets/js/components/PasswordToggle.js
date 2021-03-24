/**
 * @namespace
 * @desc Password toggle.
 */

const PasswordToggle = (function() {
	/**
	 * @memberOf Footer
	 * @desc Initialize Footer module.
	 * @access public
	 * @return {void}
	 */
	function initialize() {
		$("#password-field").click(function() {
			if($('.fa-eye').length){
				$('#password-field').html('');
				$('#password-field').html('<i class="fa fa-eye-slash"></i>');
				$('#password').attr('type', 'text');
			}else{
				$('#password-field').html('');
				$('#password-field').html('<i class="fa fa-eye"></i>');
				$('#password').attr('type', 'password');
			}
		});
	}

	return {
		initialize: initialize,
	};
})(jQuery);
