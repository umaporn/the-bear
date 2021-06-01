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
	/*function initialize(){

		$('.gif-loader').hide();

		$( document ).on( 'click', '#loadMore', function(){
			var url = $( '#loadMore' ).data( 'url' );

			$( '#loadMore' ).remove();
			$( document )
				.ajaxStart( function(){
					$('.gif-loader').show();
				} )
				.ajaxStop( function(){
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

	}*/
	/**
	 * @memberOf LoadMore
	 * @access public
	 * @desc Initialize LoadMore module.
	 * @constant {Object}
	 */
	function initialize(){

		$('.gif-loader').hide();

		$( 'body' ).on( 'touchmove', onScrollMobile ); // for mobile
		$( window ).on( 'scroll', onScrollWindow );

	}

	function onScrollMobile(){

		if( $( '#loadMore' ).length ){

			if( $( window ).scrollTop() < ( $( window ).height() - $( document ).height() ) ){

				Utility.clearErrors();
				var url = $( '#loadMore' ).data( 'url' );

				$( '#loadMore' ).remove();
				$( document )
					.ajaxStart( function(){
						$('.gif-loader').show();
					} )
					.ajaxStop( function(){
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
			}
		}
	}

	function onScrollWindow(){

		if( $( '#loadMore' ).length ){
			if( $( document ).height() >= $( window ).scrollTop() + $( window ).height() ){

				Utility.clearErrors();
				var url = $( '#loadMore' ).data( 'url' );

				$( '#loadMore' ).remove();
				$( document )
					.ajaxStart( function(){
						$('.gif-loader').show();
					} )
					.ajaxStop( function(){
						$('.gif-loader').hide();
					} );
				$.ajax( {
					        url:         url,
					        method:      'GET',
					        cache:       false,
					        contentType: false,
					        processData: false,
					        success:     function( result ){
						        $('.gif-loader').remove();
						        if( url ){
							        $( '#loadMore' ).remove();
							        $( '#content-list-box' ).append( result.data );
						        } else {
							        $( '#loadMore' ).hide();
						        }
					        },
				        } );
			}
		}
	}

	return {
		initialize: initialize,
	};
})( jQuery );
