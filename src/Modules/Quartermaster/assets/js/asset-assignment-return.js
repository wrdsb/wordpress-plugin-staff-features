(function($) {
	'use strict';

	$(document).ready(function() {
        console.log('asset-assignment-return loaded');

        $('.asset-return-button').click(function() {
            var searchID = $(this).data('searchID');
            console.log(`show input for ${searchID}`);
            $('#' + searchID + '-asset-return').show();
            $('#' + searchID + '-asset-return-button').hide();
        });

		$('.asset-return').on("change", function() {
            var blogID = $(this).data('blogID');
			var searchID = $(this).data('searchID');
            var userEmail = $(this).data('userEmail');
			console.log(`Mark asset as returned for assignment ${searchID} on blog ${blogID}`);

            $('#' + searchID + '-asset-return-button').hide();
            $('#' + searchID + '-asset-return').show();
            $('#' + searchID + '-asset-after').attr('class', 'input-group-addon');
            $('#' + searchID + '-asset-after-icon').attr('class', 'glyphicon glyphicon-cloud-upload');
            $('#' + searchID + '-asset-after').show();
            $('#' + searchID + '-asset-after-button').hide();
            $('#' + searchID + '-asset-after-icon').show();
            
            var updatedBy = userEmail;
            var returnDate = $(this).val();
            var returnedAt = returnDate.concat(' ', '00:00:00');
            var returnedBy = userEmail;
            var body = {
                updatedBy: updatedBy,
                returnedAt: returnedAt,
                returnedBy: returnedBy
            };
            console.log(`returnedAt: ${returnedAt}, by ${returnedBy}`);

            $.ajax({
                method: 'POST',
                url: `/wp-json/wrdsb/staff/quartermaster/blog/${blogID}/asset-assignment/${searchID}/return`,
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
                    $('#' + searchID + '-asset-after').attr('class', 'input-group-btn');
                    $('#' + searchID + '-asset-after-button-icon').attr('class', 'glyphicon glyphicon-remove-circle');

                    $('#' + searchID + '-asset-after').show();
                    $('#' + searchID + '-asset-after-button').show();
                    $('#' + searchID + '-asset-after-icon').hide();

                    $('#' + searchID + '-asset-actions-notifications').hide();
                    console.log(status)
                },
                error: function(xhr, status, error) {
                    $('#' + searchID + '-asset-after').attr('class', 'input-group-addon');
                    $('#' + searchID + '-asset-after-icon').attr('class', 'glyphicon glyphicon-exclamation-sign');

                    $('#' + searchID + '-asset-after').show();
                    $('#' + searchID + '-asset-after-button').hide();
                    $('#' + searchID + '-asset-after-icon').show();

                    $('#' + searchID + '-asset-actions-notifications').text('Error. Please try again.');
                    $('#' + searchID + '-asset-actions-notifications').show();
                    console.log(xhr);
                    console.log(status + ': ' + error)
                },
                complete: function(xhr, status) {
                }
            });
		});

        $('.undo-button').click(function() {
            var blogID = $(this).data('blogID');
			var searchID = $(this).data('searchID');
			console.log(`Undo asset return for assignment ${searchID} on blog ${blogID}`);

            $('#' + searchID + '-asset-return-button').hide();
            $('#' + searchID + '-asset-return').show();
            $('#' + searchID + '-asset-after').attr('class', 'input-group-addon');
            $('#' + searchID + '-asset-after-icon').attr('class', 'glyphicon glyphicon-cloud-upload');
            $('#' + searchID + '-asset-after').show();
            $('#' + searchID + '-asset-after-button').hide();
            $('#' + searchID + '-asset-after-icon').show();
            
            var body = {
                wasReturned: false,
                returnedAt: "",
                returnedBy: ""
            };
            console.log(`returnedAt: "", by ""`);

            $.ajax({
                method: 'POST',
                url: `/wp-json/wrdsb/staff/quartermaster/blog/${blogID}/asset-assignment/${searchID}`,
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
                    $('#' + searchID + '-asset-return').hide();
                    $('#' + searchID + '-asset-after').hide();
                    $('#' + searchID + '-asset-actions-notifications').hide();
                    $('#' + searchID + '-asset-return-button').show();
                    console.log(status)
                },
                error: function(xhr, status, error) {
                    $('#' + searchID + '-asset-after').attr('class', 'input-group-addon');
                    $('#' + searchID + '-asset-after-icon').attr('class', 'glyphicon glyphicon-exclamation-sign');

                    $('#' + searchID + '-asset-after').show();
                    $('#' + searchID + '-asset-after-button').hide();
                    $('#' + searchID + '-asset-after-icon').show();

                    $('#' + searchID + '-asset-actions-notifications').text('Error. Please try again.');
                    $('#' + searchID + '-asset-actions-notifications').show();
                    console.log(xhr);
                    console.log(status + ': ' + error)
                },
                complete: function(xhr, status) {
                }
            });
        });
    })
})(jQuery);
