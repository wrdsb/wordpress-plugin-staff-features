(function($) {
	'use strict';

	$(document).ready(function() {

		var table = $('#sample-data-table').DataTable( {
            dom: '<"dataTables_header"Bi>t<"dataTables_footer"i>',
            columnDefs: [
            ],
            buttons: [
            ],
            lengthMenu: [[-1], ["All"]],
            responsive: true
		} );
		
		var retrieved = new Date().toLocaleString('en-CA');

        new $.fn.dataTable.Buttons( table, {
            name: 'copy',
            buttons: [
                {
                    extend: 'copy',
                    text: 'Copy to clipboard',
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            search: 'applied',
                            order: 'applied'
                        }
                    },
                    title: document.title,
                    messageTop: 'Retrieved ' + retrieved
                }
            ]
        } );
        table.buttons( 'copy', null ).containers().appendTo('#button-copy');

        new $.fn.dataTable.Buttons( table, {
            name: 'csv',
            buttons: [
                {
                    extend: 'csv',
                    text: 'Save as CSV',
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            search: 'applied',
                            order: 'applied'
                        }
                    },
                    filename: document.title.replace(/\W+/g, '-').toLowerCase()
                }
            ]
        } );
        table.buttons( 'csv', null ).containers().appendTo('#button-csv');

        new $.fn.dataTable.Buttons( table, {
            name: 'pdf',
            buttons: [
                {
                    extend: 'pdf',
                    text: 'Save as PDF',
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            search: 'applied',
                            order: 'applied'
                        }
                    },
                    title: document.title,
                    messageTop: 'Retrieved ' + retrieved,
                    filename: document.title.replace(/\W+/g, '-').toLowerCase()
                }
            ]
        } );
        table.buttons( 'pdf', null ).containers().appendTo('#button-pdf');

		$('.form-return').click(function() {
            var blog_id = $(this).data('blog_id');
			var form_id = $(this).data('form_id');

			console.log(`Mark device as returned for form ${form_id} on blog ${blog_id}`);

			$.ajax({
				method: 'POST',
				url: `/wp-json/wrdsb/staff/quartermaster/blog/${blog_id}/device-loans/form/${form_id}/return`,
                xhrFields: {
                    withCredentials: true
                },
				beforeSend: function (xhr) {
					xhr.setRequestHeader('X-WP-Nonce', wpApiSettings.nonce);
				},
				success: function(data, status, xhr) {
                    $('#' + form_id + '-return').remove();
					$('#' + form_id + '-actions-notifications').text('Accepted for processing.');
					console.log(status)
				},
				error: function(xhr, status, error) {
					$('#' + form_id + '-actions-notifications').text('Error. Please try again.');
                    console.log(xhr);
					console.log(status + ': ' + error)
				},
				complete: function(xhr, status) {
				}
			});
		});
	})
})(jQuery);
