(function ($) {
    'use strict';

    $(document).ready(function () {
        console.log('datatable.js loaded');

        var retrieved = new Date().toLocaleString('en-CA');

        if ($('#school-data-workplace-inspection-team-table').length > 0) {
            console.log('building datatable...');

            var table = $('#school-data-workplace-inspection-team-table').DataTable({
                dom: '<"dataTables_header"Bi>t<"dataTables_footer"i>',
                columnDefs: [
                    {"targets": [3], "visible": false},
                    {"targets": [4], "visible": false},
                    {"targets": [5], "visible": false},
                    {"targets": [6], "visible": false},
                    {"targets": [7], "visible": false},
                    {"targets": [8], "visible": false},
                    {"targets": [9], "visible": false},
                    {"targets": [10], "visible": false},
                    {"targets": [11], "visible": false},
                    {"targets": [12], "visible": false},
                    {"targets": [13], "visible": false},
                    {"targets": [14], "visible": false},
                    {"targets": [15], "visible": false},
                    {"targets": [16], "visible": false},
                    {"targets": [17], "visible": false},
                    {"targets": [18], "visible": false},
                    {"targets": [19], "visible": false},
                    {"targets": [20], "visible": false},
                    {"targets": [21], "visible": false},
                    {"targets": [22], "visible": false},
                    {"targets": [23], "visible": false},
                    {"targets": [24], "visible": false},
                    {"targets": [25], "visible": false},
                    {"targets": [26], "visible": false},
                ],
                buttons: [
                    //'columnsToggle',
                ],
                lengthMenu: [[-1], ["All"]],
                responsive: true
            });

            console.log('got datatable');

            new $.fn.dataTable.Buttons(table, {
                name: 'copy',
                buttons: [
                    {
                        extend: 'copy',
                        text: 'Copy all forms to clipboard',
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
            });
            table.buttons('copy', null).containers().appendTo('#button-copy');
    
            //new $.fn.dataTable.Buttons(table, {
                //name: 'csv-visible',
                //buttons: [
                    //{
                        //extend: 'csv',
                        //text: 'Save current view as CSV',
                        //exportOptions: {
                            //columns: ':visible',
                            //modifier: {
                                //search: 'applied',
                                //order: 'applied'
                            //}
                        //},
                        //filename: document.title.replace(/\W+/g, '-').toLowerCase()
                    //}
                //]
            //});
            //table.buttons('csv-visible', null).containers().appendTo('#button-csv-visible');
    
            new $.fn.dataTable.Buttons(table, {
                name: 'csv-all',
                buttons: [
                    {
                        extend: 'csv',
                        text: 'Export all forms to CSV',
                        exportOptions: {
                            modifier: {
                                search: 'applied',
                                order: 'applied'
                            }
                        },
                        filename: document.title.replace(/\W+/g, '-').toLowerCase()
                    }
                ]
            });
            table.buttons('csv-all', null).containers().appendTo('#button-csv-all');
    
            console.log(table.buttons);
        } else {
            console.log('no datatable detected');
        }
    })
})(jQuery);
