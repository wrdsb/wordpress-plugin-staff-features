(function( $ ) {
	'use strict';

    $(document).ready(function() {

        var table = $('#sample-data-table').DataTable( {
            dom: '<"dataTables_header"B>t<"dataTables_footer"i>',
            columnDefs: [
                {
                    "targets": [ 2 ],
                    "visible": false
                },
                {
                    "targets": [ 3 ],
                    "visible": false
                }
            ],
            buttons: [
                'columnsToggle',
            ],
            lengthMenu: [[-1], ["All"]],
            responsive: true
		} );
		
		var retrieved = new Date().toLocaleString('en-CA');

        new $.fn.dataTable.Buttons( table, {
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
        } );
        table.buttons( 'copy', null ).containers().appendTo('#button-copy');

        new $.fn.dataTable.Buttons( table, {
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
        } );
        table.buttons( 'csv', null ).containers().appendTo('#button-csv');

        new $.fn.dataTable.Buttons( table, {
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
        } );
        table.buttons( 'pdf', null ).containers().appendTo('#button-pdf');

    })
})( jQuery );
