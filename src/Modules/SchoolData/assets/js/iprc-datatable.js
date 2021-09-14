(function ($) {
    'use strict';

    $(document).ready(function () {
        console.log('datatable.js loaded');

        var retrieved = new Date().toLocaleString('en-CA');

        if ($('#school-data-iprc-table').length > 0) {
            console.log('building datatable...');

            var table = $('#school-data-iprc-table').DataTable({
                dom: '<"dataTables_header"Bi>t<"dataTables_footer"i>',
                columnDefs: [
                    //{
                        //"targets": [ 1 ],
                        //"visible": false
                    //},
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
                        text: 'Copy to clipboard',
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
    
            new $.fn.dataTable.Buttons(table, {
                name: 'csv-visible',
                buttons: [
                    {
                        extend: 'csv',
                        text: 'Save current view as CSV',
                        exportOptions: {
                            columns: ':visible',
                            modifier: {
                                search: 'applied',
                                order: 'applied'
                            }
                        },
                        filename: document.title.replace(/\W+/g, '-').toLowerCase()
                    }
                ]
            });
            table.buttons('csv-visible', null).containers().appendTo('#button-csv-visible');
    
            new $.fn.dataTable.Buttons(table, {
                name: 'csv-all',
                buttons: [
                    {
                        extend: 'csv',
                        text: 'Save all columns as CSV',
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
