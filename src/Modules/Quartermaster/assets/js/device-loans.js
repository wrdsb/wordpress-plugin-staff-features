(function($) {
	'use strict';

	$(document).ready(function() {
        console.log('document ready');

        $(".input-group.date").datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            autoclose: true
        });

        //$('#receivedByBlock').hide();

        $('input[name="receivedByRole"]').click(function () {
            if ($(this).attr("value") === "student") {
                $("#receivedByBlock").hide('slow');
            }
            if ($(this).attr("value") === "other") {
                $("#receivedByBlock").show('slow');
            }
        });

        //$('#isTemporaryBlock').hide();

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

        $('.return-button').click(function() {
            var form_id = $(this).data('form_id');
            console.log(`show input for ${form_id}`);
            $('#' + form_id + '-return').show();
            $('#' + form_id + '-return-button').hide();
        });

		$('.form-return').on("change", function() {
            var blog_id = $(this).data('blog_id');
			var form_id = $(this).data('form_id');
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
			var form_id = $(this).data('form_id');
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
