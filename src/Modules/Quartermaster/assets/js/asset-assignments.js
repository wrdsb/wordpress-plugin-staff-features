(function ($) {
    'use strict';

    $(document).ready(function () {
        console.log('document ready');

        $("#startDate").datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            autoclose: true
        });

        $("#endDate").datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            autoclose: true
        });

        $('input[name="isTemporary"]').click(function () {
            if ($(this).attr("value") === "0") {
                $("#isTemporaryBlock").hide('slow');
            }
            if ($(this).attr("value") === "1") {
                $("#isTemporaryBlock").show('slow');
            }
        });

        $('input[name="wasReceivedByAssignee"]').click(function () {
            if ($(this).attr("value") === "1") {
                $("#receivedByBlock").hide('slow');
            }
            if ($(this).attr("value") === "0") {
                $("#receivedByBlock").show('slow');
            }
        });

        $('#newAssetAssignment').on('submit', function(e) {
            console.log('process new asset assignment');
            e.preventDefault();

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
                    $('#submitButton').hide();
                    $('#successMessage').show();
                    $('#failureMessage').hide();
                },
                fail: function (response) {
                    console.log(response);
                    $('#submitButton').show();
                    $('#successMessage').hide();
                    $('#failureMessage').show();
                }
            });
        });

        $('#editAssetAssignment').on('submit', function(e) {
            console.log('process asset assignment update');
            e.preventDefault();

            let searchID = $('#searchID').val();
            let blogID = $('#blogID').val();
            console.log(`for blogID ${blogID}`);

            let createdAt = $('#createdAt').val();
            let updatedAt = $('#updatedAt').val();
            let deletedAt = null;
            let deleted = false;
        
            let createdBy = $('#assignedBy').val();
            let updatedBy = $('email').val();
            let deletedBy = null;
        
            let assignedBy = $('#assignedBy').val();
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
                searchID: searchID,
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
                success: function (response) {
                    console.log(response);
                    $('#submitButton').hide();
                    $('#successMessage').show();
                    $('#failureMessage').hide();
                },
                fail: function (response) {
                    console.log(response);
                    $('#submitButton').show();
                    $('#successMessage').hide();
                    $('#failureMessage').show();
                }
            });
        });
    })
})(jQuery);