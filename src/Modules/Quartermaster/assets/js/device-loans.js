(function($) {
	'use strict';

	$(document).ready(function() {
        console.log('device-loans loaded');

        $(".input-group.date").datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            autoclose: true
        });

        $('input[name="receivedByRole"]').click(function () {
            if ($(this).attr("value") === "student") {
                $("#receivedByBlock").hide('slow');
            }
            if ($(this).attr("value") === "other") {
                $("#receivedByBlock").show('slow');
            }
        });

        $('input[name="isTemporary"]').click(function () {
            if ($(this).attr("value") === "false") {
                $("#isTemporaryBlock").hide('slow');
            }
            if ($(this).attr("value") === "true") {
                $("#isTemporaryBlock").show('slow');
            }
        });

        //$('input[name="receivedByRole"]').trigger('click');  // trigger the event

        $('#seaDeviceWarning').hide();

<<<<<<< HEAD
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

        $("#loanedToName").on("autocompleteresponse", function(event, ui ) {
            //console.log(event);
            //console.log(ui);
        });

        $("#loanedToName").on("autocompleteselect", function(event, ui) {
            let fullName = ui.item.label;
            let email = ui.item.value;
            console.log(fullName);
            console.log(email);
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

=======
>>>>>>> master
        $('.return-button').click(function() {
            var searchID = $(this).data('search_id');
            console.log(`show input for ${searchID}`);
            $('#' + searchID + '-return').show();
            $('#' + searchID + '-return-button').hide();
        });

		$('.form-return').on("change", function() {
            var blog_id = $(this).data('blog_id');
			var form_id = $(this).data('search_id');
            var user_email = $(this).data('user_email');
			console.log(`Mark device as returned for form ${form_id} on blog ${blog_id}`);

            $('#' + form_id + '-return-button').hide();
            $('#' + form_id + '-return').show();
            $('#' + form_id + '-after').attr('class', 'input-group-addon');
            $('#' + form_id + '-after-icon').attr('class', 'glyphicon glyphicon-cloud-upload');
            $('#' + form_id + '-after').show();
            $('#' + form_id + '-after-button').hide();
            $('#' + form_id + '-after-icon').show();
            
            var returnDate = $(this).val();
            var returnedAt = returnDate.concat(' ', '00:00:00');
            var returnedBy = user_email;
            var body = {
                returnedAt: returnedAt,
                returnedBy: returnedBy
            };
            console.log(`returnedAt: ${returnedAt}, by ${returnedBy}`);

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
                    $('#' + form_id + '-after').attr('class', 'input-group-btn');
                    $('#' + form_id + '-after-button-icon').attr('class', 'glyphicon glyphicon-remove-circle');

                    $('#' + form_id + '-after').show();
                    $('#' + form_id + '-after-button').show();
                    $('#' + form_id + '-after-icon').hide();

                    $('#' + form_id + '-actions-notifications').hide();
                    console.log(status)
                },
                error: function(xhr, status, error) {
                    $('#' + form_id + '-after').attr('class', 'input-group-addon');
                    $('#' + form_id + '-after-icon').attr('class', 'glyphicon glyphicon-exclamation-sign');

                    $('#' + form_id + '-after').show();
                    $('#' + form_id + '-after-button').hide();
                    $('#' + form_id + '-after-icon').show();

                    $('#' + form_id + '-actions-notifications').text('Error. Please try again.');
                    $('#' + form_id + '-actions-notifications').show();
                    console.log(xhr);
                    console.log(status + ': ' + error)
                },
                complete: function(xhr, status) {
                }
            });
		});

        $('.undo-button').click(function() {
            var blog_id = $(this).data('blog_id');
			var form_id = $(this).data('search_id');
			console.log(`Undo device return for form ${form_id} on blog ${blog_id}`);

            $('#' + form_id + '-return-button').hide();
            $('#' + form_id + '-return').show();
            $('#' + form_id + '-after').attr('class', 'input-group-addon');
            $('#' + form_id + '-after-icon').attr('class', 'glyphicon glyphicon-cloud-upload');
            $('#' + form_id + '-after').show();
            $('#' + form_id + '-after-button').hide();
            $('#' + form_id + '-after-icon').show();
            
            var body = {
                wasReturned: false,
                returnedAt: "",
                returnedBy: ""
            };
            console.log(`returnedAt: "", by ""`);

            $.ajax({
                method: 'POST',
                url: `/wp-json/wrdsb/staff/quartermaster/blog/${blog_id}/device-loans/form/${form_id}`,
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
                    $(".input-group.date").datepicker('hide');
                    $('#' + form_id + '-return').hide();
                    $('#' + form_id + '-after').hide();
                    $('#' + form_id + '-actions-notifications').hide();
                    $('#' + form_id + '-return-button').show();
                    console.log(status)
                },
                error: function(xhr, status, error) {
                    $('#' + form_id + '-after').attr('class', 'input-group-addon');
                    $('#' + form_id + '-after-icon').attr('class', 'glyphicon glyphicon-exclamation-sign');

                    $('#' + form_id + '-after').show();
                    $('#' + form_id + '-after-button').hide();
                    $('#' + form_id + '-after-icon').show();

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
