
<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->

    <!-- Default to the left -->
    <strong>En Uygun Case Study  <a href="#">Kubilay Temel</a>.</strong>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('assets')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- DataTables -->
<script src="{{asset('assets')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('assets')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('assets')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('assets')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets')}}/dist/js/adminlte.min.js"></script>

<script>
    function format ( d ) {
        let _text = '';
        $.each( d, function( key, value ) {
            console.log( key + ": " + value.title );
            _text +="Task Name: "+value.title+" <br>" +
                "Difficulty: "+value.difficulty+" <br>" +
                "Duration: "+value.duration+" <hr>";
        });

        return _text;
    }

    $(document).ready(function() {
        var dt = $('#example').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": "{{route('developer.list')}}",
            "columns": [
                {
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": "<a class='btn btn-success btn-sm' style='color:#fff;'>Detail</a>"
                },
                { "data": "developer" }


            ],
            //"order": [[1, 'asc']]
        } );

        // Array to track the ids of the details displayed rows
        var detailRows = [];

        $('#example tbody').on( 'click', 'tr td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = dt.row( tr );
            var idx = $.inArray( tr.attr('id'), detailRows );

            if ( row.child.isShown() ) {
                tr.removeClass( 'details' );
                row.child.hide();

                // Remove from the 'open' array
                detailRows.splice( idx, 1 );
            }
            else {
                tr.addClass( 'details' );
                console.log(row.data().task);
                row.child( format( row.data().task ) ).show();

                // Add to the 'open' array
                if ( idx === -1 ) {
                    detailRows.push( tr.attr('id') );
                }
            }
        } );

        // On each draw, loop over the `detailRows` array and show any child rows
        dt.on( 'draw', function () {
            $.each( detailRows, function ( i, id ) {
                $('#'+id+' td.details-control').trigger( 'click' );
            } );
        });
        });




</script>

</body>
</html>
