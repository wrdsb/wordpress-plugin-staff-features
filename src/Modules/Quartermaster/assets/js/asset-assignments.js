(function ($) {
    'use strict';

    $(document).ready(function () {
        console.log('document ready');

        $('#newAssetAssignment').on('submit', function(e) {
            e.preventDefault();
            let createdAt = $('createdAt').val();
            let updatedAt = null;
            let deletedAt = null;
            let deleted = false;
        
            let createdBy = $('assignedBy').val();
            let updatedBy = null;
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
				url: `/wp-json/wrdsb/staff/quartermaster/blog/${blog_id}/device-loans/form/`,
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