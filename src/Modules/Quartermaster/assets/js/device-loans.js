(function($) {
	'use strict';

	$(document).ready(function() {
        console.log('document ready');

        $(".input-group.date").datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            autoclose: true
        });

        $('#receivedByBlock').hide();

        $('input[name="receivedByRole"]').click(function () {
            if ($(this).attr("value") === "student") {
                $("#receivedByBlock").hide('slow');
            }
            if ($(this).attr("value") === "other") {
                $("#receivedByBlock").show('slow');

            }
        });

        //$('input[name="receivedByRole"]').trigger('click');  // trigger the event

        $('#seaDeviceWarning').hide();

        var availableTags = [
            "Choice 1",
            "Choice 2",
            "Choice 3",
            "Choice 4",
            "Choice 5",
            "Choice 6",
            "Choice 7",
            "Option 1",
            "Option 2",
            "Option 3",
            "Option 4",
            "Option 5",
            "Option 6",
            "Option 7"
        ];

        $("#loanedToName").autocomplete({
            autoFocus: true,
            delay: 500,
            minLength: 3,
            source: availableTags
        });

        $("#loanedToName").on("autocompleteselect", function(event, ui) {
            $('input[name="loanedToEmail"]').val("something");
            $('input[name="loanedToNumber"]').val("something else");
        });

        $("#assetID").autocomplete({
            autoFocus: true,
            delay: 500,
            minLength: 3,
            source: availableTags
        });

        $("#assetID").on("autocompleteselect", function(event, ui) {
            $('input[name="assetType"]').val("something");
            $('input[name="assetModel"]').val("something else");
        });

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

		$('.form-return').on("change", function() {
            $('#' + form_id + '-status').attr('class', 'glyphicon glyphicon-cloud-upload');

            var blog_id = $(this).data('blog_id');
			var form_id = $(this).data('form_id');
			console.log(`Mark device as returned for form ${form_id} on blog ${blog_id}`);
            
            var returnDate = $(this).val();
            var returnedAt = returnDate;
            var body = {
                returnedAt: returnDate
            };
            console.log(`returnedAt: ${returnedAt}`);

            $.ajax({
                method: 'POST',
                url: `/wp-json/wrdsb/staff/quartermaster/blog/${blog_id}/device-loans/form/${form_id}/return`,
                data: JSON.stringify(body),
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
                xhrFields: {
                    withCredentials: true
                },
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-WP-Nonce', wpApiSettings.nonce);
                },
                success: function(data, status, xhr) {
                    $('#' + form_id + '-status').attr('class', 'glyphicon glyphicon-ok-circle');
                    $('#' + form_id + '-actions-notifications').hide();
                    console.log(status)
                },
                error: function(xhr, status, error) {
                    $('#' + form_id + '-status').attr('class', 'glyphicon glyphicon-remove-circle');
                    $('#' + form_id + '-actions-notifications').text('Error. Please try again.');
                    $('#' + form_id + '-actions-notifications').show();
                    console.log(xhr);
                    console.log(status + ': ' + error)
                },
                complete: function(xhr, status) {
                }
            });
		});
	})
})(jQuery);
