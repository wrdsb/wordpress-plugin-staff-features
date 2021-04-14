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

        $('#isTemporaryBlock').hide();

        $('input[name="isTemporary"]').click(function () {
            if ($(this).attr("value") === "0") {
                $("#isTemporaryBlock").hide('slow');
            }
            if ($(this).attr("value") === "1") {
                $("#isTemporaryBlock").show('slow');
            }
        });

        $('#receivedByBlock').hide();

        $('input[name="wasReceivedByAssignee"]').click(function () {
            if ($(this).attr("value") === "1") {
                $("#receivedByBlock").hide('slow');
            }
            if ($(this).attr("value") === "0") {
                $("#receivedByBlock").show('slow');
            }
        });

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

        $("#assignedToPerson").autocomplete({
            autoFocus: true,
            delay: 300,
            minLength: 3,
            source: '/wp-json/wrdsb/staff/codex/people-search-suggest'
        });

        $("#assignedToPerson").on("autocompleteresponse", function(event, ui ) {
            console.log(event);
            console.log(ui);
        });

        $("#assignedToPerson").on("autocompleteselect", function(event, ui) {
            $('input[name="assignedToPersonEmail"]').val("something");
            $('input[name="assignedToPersonNumber"]').val("something else");
        });

        $("#assetID").autocomplete({
            autoFocus: true,
            delay: 300,
            minLength: 3,
            source: availableTags
        });

        $("#assetID").on("autocompleteselect", function(event, ui) {
            $('input[name="assetType"]').val("something");
            $('input[name="assetModel"]').val("something else");
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
            if ($("input:radio[name='wasReceivedByAssignee']:checked").val() === '0') {
                wasReceivedByAssignee = false;
                receivedBy = $('#receivedBy').val();
            } else {
                wasReceivedByAssignee = true;
                receivedBy = assignedToPerson;
            }

            let receivedByRole = $('#receivedByRole').val();
        
            let isTemporary = false;
            if ($("input:radio[name='isTemporary']:checked").val() === '0') {
                isTemporary = false;
            } else {
                isTemporary = true;
            }

            let startDate = $('#startDate').val();
            let endDate = $('#endDate').val();

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
            e.preventDefault();
            let id = $('assignmentID').val();

            let createdAt = $('createdAt').val();
            let updatedAt = $('updatedAt').val();
            let deletedAt = null;
            let deleted = false;
        
            let createdBy = $('assignedBy').val();
            let updatedBy = $('email').val();
            let deletedBy = null;
        
            let assignedBy = $('assignedBy').val();
            let assignedFromLocation = $('assignedFromLocation').val();
        
            let assetID = $('assetID').val();
            let assetSerialNumber = $('assetSerialNumber').val();
            let assetType = $('assetType').val();
            let assetLocation = $('assetLocation').val();
            
            let assignedToPerson = $('assignedToPerson').val();
            let assignedToPersonEmail = $('assignedToPersonEmail').val();
            let assignedToPersonNumber = $('assignedToPersonNumber').val();
            let assignedToPersonLocation = $('assignedToPersonLocation').val();
        
            let assignedToBusinessUnit = null;
        
            let wasReceivedByAssignee = $('wasReceivedByAssignee').val();

            let receivedBy = null;
            if (wasReceivedByAssignee === true) {
                receivedBy = assignedToPerson;
            } else {
                receivedBy = $('receivedBy').val();
            }

            let receivedByRole = $('receivedByRole').val();
        
            let isTemporary = $('isTemporary').val();
            let startDate = $('startDate').val();
            let endDate = $('endDate').val();
        
            let untrackedAssestsIncluded = $('untrackedAssestsIncluded').val();
            let notes = $('notes').val();

            var data = {
                id: id,
                createdAt: createdAt,
                updatedAt: updatedAt,
                deletedAt: deletedAt,
                deleted: deleted,
                createdBy: createdBy,
                updatedBy: updatedBy,
                deletedBy: deletedBy,
                assignedBy: assignedBy,
                assignedFromLocation: assignedFromLocation,
                id: id,
                changeDetectionHash: changeDetectionHash,
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
                untrackedAssestsIncluded: untrackedAssestsIncluded,
                notes: notes
            };

            $.ajax({
                method: "POST",
				url: `/wp-json/wrdsb/staff/quartermaster/blog/${blog_id}/device-loans/form/${form_id}/edit`,
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
                    alert(POST_SUBMITTER.success);
                },
                fail: function (response) {
                    console.log(response);
                    alert(POST_SUBMITTER.failure);
                }
            });
        });
    })
})(jQuery);