<!DOCTYPE html>
<html lang="en-us">

<head>
    <title>Data Table</title>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="../assets/favicon.ico" />

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700italic,700,900,900italic" rel="stylesheet">

    <!-- STYLESHEETS -->
    <style type="text/css">
            [fuse-cloak],
            .fuse-cloak {
                display: none !important;
            }
        </style>

    <!-- Icons.css -->
    <link type="text/css" rel="stylesheet" href="../assets/icons/fuse-icon-font/style.css">
    <!-- Animate.css -->
    <link type="text/css" rel="stylesheet" href="../assets/node_modules/animate.css/animate.min.css">
    <!-- PNotify -->
    <link type="text/css" rel="stylesheet" href="../assets/node_modules/pnotify/dist/PNotifyBrightTheme.css">
    <!-- Nvd3 - D3 Charts -->
    <link type="text/css" rel="stylesheet" href="../assets/node_modules/nvd3/build/nv.d3.min.css" />
    <!-- Perfect Scrollbar -->
    <link type="text/css" rel="stylesheet" href="../assets/node_modules/perfect-scrollbar/css/perfect-scrollbar.css" />
    <!-- Fuse Html -->
    <link type="text/css" rel="stylesheet" href="../assets/fuse-html/fuse-html.min.css" />
    <!-- Main CSS -->
    <link type="text/css" rel="stylesheet" href="../assets/css/main.css">
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <!-- / STYLESHEETS -->

    <!-- JAVASCRIPT -->
    <!-- jQuery -->
    <script type="text/javascript" src="../assets/node_modules/jquery/dist/jquery.min.js"></script>
    <!-- Mobile Detect -->
    <script type="text/javascript" src="../assets/node_modules/mobile-detect/mobile-detect.min.js"></script>
    <!-- Perfect Scrollbar -->
    <script type="text/javascript" src="../assets/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
    <!-- Popper.js -->
    <script type="text/javascript" src="../assets/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <!-- Bootstrap -->
    <script type="text/javascript" src="../assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Nvd3 - D3 Charts -->
    <script type="text/javascript" src="../assets/node_modules/d3/d3.min.js"></script>
    <script type="text/javascript" src="../assets/node_modules/nvd3/build/nv.d3.min.js"></script>
    <!-- Data tables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fh-3.1.4/r-2.2.2/datatables.min.css"/>
 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fh-3.1.4/r-2.2.2/datatables.min.js"></script>

    <!-- PNotify -->
    <script type="text/javascript" src="../assets/node_modules/pnotify/dist/iife/PNotify.js"></script>
    <script type="text/javascript" src="../assets/node_modules/pnotify/dist/iife/PNotifyStyleMaterial.js"></script>
    <script type="text/javascript" src="../assets/node_modules/pnotify/dist/iife/PNotifyButtons.js"></script>
    <script type="text/javascript" src="../assets/node_modules/pnotify/dist/iife/PNotifyCallbacks.js"></script>
    <script type="text/javascript" src="../assets/node_modules/pnotify/dist/iife/PNotifyMobile.js"></script>
    <script type="text/javascript" src="../assets/node_modules/pnotify/dist/iife/PNotifyHistory.js"></script>
    <script type="text/javascript" src="../assets/node_modules/pnotify/dist/iife/PNotifyDesktop.js"></script>
    <script type="text/javascript" src="../assets/node_modules/pnotify/dist/iife/PNotifyConfirm.js"></script>
    <script type="text/javascript" src="../assets/node_modules/pnotify/dist/iife/PNotifyReference.js"></script>
    <!-- Fuse Html -->
    <script type="text/javascript" src="../assets/fuse-html/fuse-html.min.js"></script>
    <!-- Main JS -->
    <script type="text/javascript" src="../assets/js/main.js"></script>
	<script type="text/javascript" class="init">
        $(document).ready(function() {

            var table = $('#sample-data-table').DataTable( {
                dom: '<"dataTables_header"Bf>t<"dataTables_footer"i>',
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
                        title: 'Class Name',
                        messageTop: 'Accurate as of DATETIME'
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
                        filename: 'class-name'
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
                        title: 'Class Name',
                        messageTop: 'Accurate as of DATETIME',
                        filename: 'class-name'
                    }
                ]
            } );
            table.buttons( 'pdf', null ).containers().appendTo('#button-pdf');

        } );
    </script>
    <!-- / JAVASCRIPT -->
</head>
