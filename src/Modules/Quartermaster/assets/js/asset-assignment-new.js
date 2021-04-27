(function ($) {
    'use strict';

    $(document).ready(function () {
        console.log('asset-assignment-new loaded');

        $('#newAssetAssignment').on('submit', function(e) {
            e.preventDefault();

            console.log('process new asset assignment');

            $("#progressbar").progressbar({value: 25});
            $('#submitButton').hide();
            $('#submittedMessage').show();
            $('#acceptedMessage').hide();
            $('#failureMessage').hide();

            let blogID = $('#blogID').val();
            console.log(`for blogID ${blogID}`);

            let createdAt = $('#createdAt').val();
            let updatedAt = null;
            let deletedAt = null;
            let deleted = false;
        
            let createdBy = $('#email').val();
            let updatedBy = null;
            let deletedBy = null;
        
            let assignedBy = $('#email').val();
            let assignedFromLocation = $('#assignedFromLocation').val();
        
            let assetID = $('#assetID').val();
            let assetSerialNumber = $('#assetSerialNumber').val();
            let assetType = $('#assetType').val();
            let assetLocation = $('#assetLocation').val();
            
            let assignedToPerson = $('#assignedToPerson').val();
            let assignedToPersonEmail = $('#assignedToPersonEmail').val();
            let assignedToPersonNumber = $('#assignedToPersonNumber').val();
            let assignedToPersonLocation = $('#assignedToPersonLocation').val();
        
            let assignedToBusinessUnit = null;
        
            let wasReceivedByAssignee = true;
            let receivedBy = assignedToPerson;
            let receivedByRole = '';

            if ($("input:radio[name='wasReceivedByAssignee']:checked").val() === '0') {
                wasReceivedByAssignee = false;
                receivedBy = $('#receivedBy').val();
                receivedByRole = $('#receivedByRole').val();
            } else {
                wasReceivedByAssignee = true;
                receivedBy = assignedToPerson;
                receivedByRole = '';
            }
        
            let isTemporary = false;
            let startDate = '';
            let endDate = '';

            if ($("input:radio[name='isTemporary']:checked").val() === '0') {
                isTemporary = false;
                startDate = $('#startDate').val();
                endDate = '';
            } else {
                isTemporary = true;
                startDate = $('#startDate').val();
                endDate = $('#endDate').val();
            }

            let wasReturned = false; 
            let returnedAt = null;
            let returnedBy = null;

            let untrackedAssestsIncluded = $('#untrackedAssestsIncluded').val();
            let notes = $('#notes').val();
        
            var body = {
                createdAt: createdAt,
                updatedAt: updatedAt,
                deletedAt: deletedAt,
                deleted: deleted,
                createdBy: createdBy,
                updatedBy: updatedBy,
                deletedBy: deletedBy,
                assignedBy: assignedBy,
                assignedFromLocation: assignedFromLocation,
                assetID: assetID,
                assetSerialNumber: assetSerialNumber,
                assetType: assetType,
                assetLocation: assetLocation,
                assignedToPerson: assignedToPerson,
                assignedToPersonEmail: assignedToPersonEmail,
                assignedToPersonNumber: assignedToPersonNumber,
                assignedToPersonLocation: assignedToPersonLocation,
                assignedToBusinessUnit: assignedToBusinessUnit,
                wasReceivedByAssignee: wasReceivedByAssignee,
                receivedBy: receivedBy,
                receivedByRole: receivedByRole,
                isTemporary: isTemporary,
                startDate: startDate,
                endDate: endDate,
                wasReturned: wasReturned,
                returnedAt: returnedAt,
                returnedBy: returnedBy,
                untrackedAssestsIncluded: untrackedAssestsIncluded,
                notes: notes
            };

            console.log(JSON.stringify(body));

            $.ajax({
                method: "POST",
				url: `/wp-json/wrdsb/staff/quartermaster/blog/${blogID}/asset-assignments`,
                data: JSON.stringify(body),
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
                xhrFields: {
                    withCredentials: true
                },
				beforeSend: function (xhr) {
					xhr.setRequestHeader('X-WP-Nonce', wpApiSettings.nonce);
				},
                success: function (response) {
                    console.log(response);
                    $("#progressbar").progressbar({value: 50});
                    $('#submitButton').hide();
                    $('#submittedMessage').hide();
                    $('#acceptedMessage').show();
                    $('#failureMessage').hide();
                    setTimeout(function () {
                        $("#progressbar").progressbar({value: 75});
                        $('#acceptedMessage').hide();
                        $('#processingMessage').show();
                        setTimeout(function () {
                            $("#progressbar").progressbar({value: 100});
                            $('#processingMessage').hide();
                            $('#finishedMessage').show();
                            setTimeout(function () {
                                $("#progressbar").hide();
                                $('#finishedMessage').hide();
                                $('#continueButton').show();
                            }, 2000);
                        }, 3000);
                    }, 2500);
                },
                fail: function (response) {
                    console.log(response);
                    $('#submitButton').show();
                    $('#failureMessage').show();
                    $("#progressbar").hide();
                    $('#submittedMessage').hide();
                    $('#acceptedMessage').hide();
                }
            });
        });
    })
})(jQuery);