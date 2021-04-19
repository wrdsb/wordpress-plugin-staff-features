(function ($) {
    'use strict';

    $(document).ready(function () {
        console.log('document ready');

        $(".staff-email").autocomplete({
            autoFocus: true,
            delay: 300,
            minLength: 3,
            source: '/wp-json/wrdsb/staff/codex/search/suggest/flenderson-people/email'
        });


        $(".staff-fullName").autocomplete({
            autoFocus: true,
            delay: 300,
            minLength: 3,
            source: '/wp-json/wrdsb/staff/codex/search/suggest/flenderson-people/fullName'
        });


        $(".student-email").autocomplete({
            autoFocus: true,
            delay: 300,
            minLength: 3,
            source: '/wp-json/wrdsb/staff/codex/search/suggest/skinner-students/email'
        });


        $(".student-fullName").autocomplete({
            autoFocus: true,
            delay: 300,
            minLength: 3,
            source: '/wp-json/wrdsb/staff/codex/search/suggest/skinner-students/fullName'
        });
    })
})(jQuery);