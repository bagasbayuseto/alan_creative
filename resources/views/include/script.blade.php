<script src="{{ asset('asset/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('asset/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('asset/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('asset/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('asset/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('asset/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('asset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('asset/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('asset/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('asset/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('asset/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('asset/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('asset/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script src="{{ asset('asset/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "searching": true,
            "buttons": [
                "copy",
                "csv",
                "excel",
                "pdf",
                "print",
                // "colvis"
            ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

    // $(function() {
    //     $('#summernote').summernote()
    // })

    // $(function() {
    //     bsCustomFileInput.init();
    // });
</script>
