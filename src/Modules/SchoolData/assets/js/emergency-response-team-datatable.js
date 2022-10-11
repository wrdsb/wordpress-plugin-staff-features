(function ($) {
    'use strict';

    $(document).ready(function () {
        console.log('datatable.js loaded');

        var retrieved = new Date().toLocaleString('en-CA');

        if ($('#school-data-emergency-response-team-table').length > 0) {
            console.log('building datatable...');

            var table = $('#school-data-emergency-response-team-table').DataTable({
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
                    {"targets": [27], "visible": false},
                    {"targets": [28], "visible": false},
                    {"targets": [29], "visible": false},
                    {"targets": [30], "visible": false},
                    {"targets": [31], "visible": false},
                    {"targets": [32], "visible": false},
                    {"targets": [33], "visible": false},
                    {"targets": [34], "visible": false},
                    {"targets": [35], "visible": false},
                    {"targets": [36], "visible": false},
                    {"targets": [37], "visible": false},
                    {"targets": [38], "visible": false},
                    {"targets": [39], "visible": false},
                    {"targets": [40], "visible": false},
                    {"targets": [41], "visible": false},
                    {"targets": [42], "visible": false},
                    {"targets": [43], "visible": false},
                    {"targets": [44], "visible": false},
                    {"targets": [45], "visible": false},
                    {"targets": [46], "visible": false},
                    {"targets": [47], "visible": false},
                    {"targets": [48], "visible": false},
                    {"targets": [49], "visible": false},
                    {"targets": [50], "visible": false},
                    {"targets": [51], "visible": false},
                    {"targets": [52], "visible": false},
                    {"targets": [53], "visible": false},
                    {"targets": [54], "visible": false},
                    {"targets": [55], "visible": false},
                    {"targets": [56], "visible": false},
                    {"targets": [57], "visible": false},
                    {"targets": [58], "visible": false},
                    {"targets": [59], "visible": false},
                    {"targets": [60], "visible": false},
                    {"targets": [61], "visible": false},
                    {"targets": [62], "visible": false},
                    {"targets": [63], "visible": false},
                    {"targets": [64], "visible": false},
                    {"targets": [65], "visible": false},
                    {"targets": [66], "visible": false},
                    {"targets": [67], "visible": false},
                    {"targets": [68], "visible": false},
                    {"targets": [69], "visible": false},
                    {"targets": [70], "visible": false},
                    {"targets": [71], "visible": false},
                    {"targets": [72], "visible": false},
                    {"targets": [73], "visible": false},
                    {"targets": [74], "visible": false},
                    {"targets": [75], "visible": false},
                    {"targets": [76], "visible": false},
                    {"targets": [77], "visible": false},
                    {"targets": [78], "visible": false},
                    {"targets": [79], "visible": false},
                    {"targets": [80], "visible": false},
                    {"targets": [81], "visible": false},
                    {"targets": [82], "visible": false},
                    {"targets": [83], "visible": false},
                    {"targets": [84], "visible": false},
                    {"targets": [85], "visible": false},
                    {"targets": [86], "visible": false},
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
