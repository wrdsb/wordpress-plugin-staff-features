(function ($) {
    'use strict';

    $(document).ready(function () {
        console.log('datatable.js loaded');

        var retrieved = new Date().toLocaleString('en-CA');

        if ($('#school-data-data-table').length > 0) {
            console.log('building datatable...');

            var table = $('#school-data-data-table').DataTable({
                dom: '<"dataTables_header"Bi>t<"dataTables_footer"i>',
                columnDefs: [
                    {
                        "targets": [ 1 ],
                        "visible": false
                    },
                ],
                buttons: [
                    'columnsToggle',
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
                name: 'csv',
                buttons: [
                    {
                        extend: 'csv',
                        text: 'Save as CSV',
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
            table.buttons('csv', null).containers().appendTo('#button-csv');
    
            new $.fn.dataTable.Buttons(table, {
                name: 'pdf',
                buttons: [
                    {
                        extend: 'pdf',
                        text: 'Save as PDF',
                        exportOptions: {
                            columns: ':visible',
                            modifier: {
                                search: 'applied',
                                order: 'applied'
                            }
                        },
                        title: document.title,
                        messageTop: 'Retrieved ' + retrieved,
                        filename: document.title.replace(/\W+/g, '-').toLowerCase()
                    }
                ]
            });
            table.buttons('pdf', null).containers().appendTo('#button-pdf');

            console.log(table.buttons);
        } else {
            console.log('no datatable detected');
        }
    })
})(jQuery);
