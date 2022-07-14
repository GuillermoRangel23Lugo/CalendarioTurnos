    <script src="{{asset('bootstrap/jquery.slim.min.js')}}"></script>
    <script src="{{asset('bootstrap/popper.min.js')}}"></script>
    <script src="{{asset('bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('bootstrap/bootstrap-datepicker.min.js')}}"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('.datatable').DataTable({
                responsive: true
            });
            $('.datepicker').datepicker({});
        } );
    </script>
</body>
</html>