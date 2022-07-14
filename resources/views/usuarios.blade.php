@include('header')
<div class="container">
    <h4 class="mb-4">Listado de Usuarios</h4>
    <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Fecha de Nacimiento</th>
                    <th scope="col">Nivel</th>
                    <th scope="col">Status</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $data)
                    <tr>
                        <td>1</td>
                        <td>{{ $data->nombre}}</td>
                        <td>{{ $data->email}}</td>
                        <td>{{ $data->documento}}</td>
                        <td>{{ $data->fecha_nacimiento}}</td>
                        <td>{{ $data->nivel}}</td>
                        <td>
                            @if ($data->status == 1)
                                <span class="text-success">Habilitado</span>
                            @else
                                <span class="text-danger">Deshabilitado</span>
                            @endif
                        </td>
                        <td>
                            <a href="#a" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Deshabilitar Usuario"><i class="fas fa-times"></i></a>
                            <a href="#a" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Habilitar Usuario"><i class="fas fa-check"></i></a>
                            <a href="#a" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Elimimnar Usuario"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('crear.usuario') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" name="apellido" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Documento</label>
                        <input type="text" name="documento" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="email" name="email" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Fecha de Nacimiento</label>
                        <input type="text" name="fecha_nacimiento" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nivel</label>
                        <select name="nivel" required class="form-control">
                            <option value="">Seleccione</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Ingeniero">Ingeniero</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@include('footer')