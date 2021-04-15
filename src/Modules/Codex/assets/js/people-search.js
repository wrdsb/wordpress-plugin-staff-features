(function ($) {
    'use strict';

    $(document).ready(function () {
        console.log('document ready');

        $(".staff-email").autocomplete({
            autoFocus: true,
            delay: 300,
            minLength: 3,
            source: '/wp-json/wrdsb/staff/codex/people-search-suggest'
        });

        $(".staff-email").on("autocompleteresponse", function(event, ui ) {
            //console.log(event);
            //console.log(ui);
        });

        $(".staff-email").on("autocompleteselect", function(event, ui) {
            let fullName = ui.item.label;
            let email = ui.item.value;
            console.log(fullName);
            console.log(email);
        });
    })
})(jQuery);