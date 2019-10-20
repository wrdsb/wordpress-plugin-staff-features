(function($) {
	'use strict';

	$(document).ready(function() {

		$('.form-entered').click(function() {
			var form_id = $(this).data('form_id');

			console.log('Mark form as processed for form ID ' + form_id);

			$.ajax({
				method: 'POST',
				url: `/wp-json/wrdsb/staff/employee/absence/form/${form_id}/processed`,
				beforeSend: function (xhr) {
					xhr.setRequestHeader('X-WP-Nonce', wpApiSettings.nonce);
				},
				success: function(data, status, xhr) {
					$('#' + form_id + '-checkbox').prop("checked", true);
					$('#' + form_id + '-processed-ajax').text('Form Processed.');
					console.log(status)
				},
				error: function(xhr, status, error) {
					$('#' + form_id + '-checkbox').prop("checked", false);
					$('#' + form_id + '-processed-ajax').text('Error. Please try again.');
					console.log(status + ': ' + error)
				},
				complete: function(xhr, status) {
				}
			});
		});

		$('.form-trash').click(function() {
			var form_id = $(this).data('form_id');

			console.log('Mark form as trashed for form ID ' + form_id);

			$.ajax({
				method: 'DELETE',
				url: `/wp-json/wrdsb/staff/employee/absence/form/${form_id}`,
				beforeSend: function (xhr) {
					xhr.setRequestHeader('X-WP-Nonce', wpApiSettings.nonce);
				},
				success: function(data, status, xhr) {
					$('#' + form_id + '-row').remove();
					console.log(status)
				},
				error: function(xhr, status, error) {
					$('#' + form_id + '-actions-notifications').text('Error. Please try again.');
					console.log(status + ': ' + error)
				},
				complete: function(xhr, status) {
				}
			});
		});
	})
})(jQuery);
