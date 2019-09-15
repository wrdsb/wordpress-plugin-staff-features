(function($) {
	'use strict';

	$( document ).ready( function() {

		$( '.form-entered' ).click(function() {
			var form_id = $(this).data('form_id');

			// set ajax data
			var data = {
				'entered': 'true'
			};

			$.post( settings.ajaxurl, data, function( response ) {

				if ( response.success ) {
					$( '#' + post_id + '-scoring-row' ).removeClass( 'wcssaa-hide' );
		
					$( '#' + post_id + '-scoring-form-row' ).addClass( 'wcssaa-hide' );
					$button.width( $button.width() ).text('Update');
		
					// display success message
					$('.update-scoring-response.post-id-' + post_id).html( 'Scoring updated.' );
		
		
					$( '#' + post_id + '-scoring-row-scoring' ).html(scoring);
		
				} else {
		
				}
			});
		
			if ( $(this).is(':checked') ) {
				$( '#' + form_id + '-row' ).removeClass( 'unentered' );
			} else {
				$( '#' + form_id + '-row' ).addClass( 'unentered' );
			}

		});

	})
})(jQuery);
