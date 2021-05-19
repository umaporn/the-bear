/**
 * @namespace
 * @desc Handles lazy load management.
 */
const LazyLoad = (function(){
	/**
	 * @memberOf LazyLoad
	 * @access public
	 * @desc Initialize LazyLoad module.
	 */
	function initialize(){
		$('.gif-loader').hide();
		$( document ).on( 'click', '#loadMore', function(){
			var url = $( '#loadMore' ).data( 'url' );

			$( '#loadMore' ).remove();
			$( document )
				.ajaxStart( function(){
					window.console.log('start');
					$('.gif-loader').show();
				} )
				.ajaxStop( function(){
					window.console.log('stop');
					$('.gif-loader').hide();
				} );
			$.ajax( {
				        url:         url,
				        method:      'GET',
				        cache:       false,
				        contentType: false,
				        processData: false,
				        success:     function( result ){
					        if( url ){
						        $( '#loadMore' ).remove();
						        $( '#content-list-box' ).append( result.data );
					        } else {
						        $( '#loadMore' ).hide();
					        }
				        },
			        } );
		} );

	}

	return {
		initialize: initialize,
	};
})( jQuery );
