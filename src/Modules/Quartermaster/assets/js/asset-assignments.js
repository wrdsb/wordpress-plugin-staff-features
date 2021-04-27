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
    })
})(jQuery);