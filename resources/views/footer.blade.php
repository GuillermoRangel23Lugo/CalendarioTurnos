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
            $('.datepicker').datepicker({
                format: "dd/mm/yyyy",
            });
            $('html').on('click', '.editar_usuario', function(evt){
                var nombre = $(this).data('nombre');
                var apellido = $(this).data('apellido');
                var documento = $(this).data('documento');
                var email = $(this).data('email');
                var email = $(this).data('email');
                var nivel = $(this).data('nivel');
                var color = $(this).data('color');
                var fecha_nacimiento = $(this).data('fecha_nacimiento');
                var url = $(this).data('url');

                $('#nombre').val(nombre);
                $('#apellido').val(apellido);
                $('#documento').val(documento);
                $('#email').val(email);
                $('#email').val(email);
                $('#nivel').val(nivel);
                $('#color').val(color);
                $('#fecha_nacimiento').val(fecha_nacimiento);
                $('#form_editar_usuario').attr('action', url);

                $('#editar_usuario').modal('show');
            });
            $('html').on('click', '.editar_servicio', function(evt){
                var servicio = $(this).data('servicio');
                var url = $(this).data('url');

                $('#servicio').val(servicio);
                $('#form_editar_servicio').attr('action', url);

                $('#editar_servicio').modal('show');
            });
            $('html').on('click', '.editar_turno', function(evt){
                var hora = $(this).data('hora');
                var fecha = $(this).data('fecha');
                var id_usuario = $(this).data('id_usuario');
                var url = $(this).data('url');

                $('#hora').val(hora);
                $('#fecha').val(fecha);
                $('#id_usuario').val(id_usuario);
                $('#form_editar_turno').attr('action', url);

                $('#editar_turno').modal('show');
            });
        } );
    </script>
</body>
</html>