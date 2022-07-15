@include('header')
<div class="container">
    <h4 class="mb-4">
        Listado de Turnos ({{ $servicio->servicio }})
        <button class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#registrar_turno">Registrar Turno</button>
    </h4>
    
    @if ($errors->has('turno'))
        <p class="text-danger">{{ $errors->first('turno') }}</p>
    @endif
    <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Turno</th>
                    <th scope="col">Status</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($turnos as $data)
                    <tr>
                        <td>1</td>
                        <td>{{ $data->turno }}</td>
                        <td>
                            @if ($data->status == 1)
                                <span class="text-success">Habilitado</span>
                            @else
                                <span class="text-danger">Deshabilitado</span>
                            @endif
                        </td>
                        <td>
                            @if ($data->status == 1)
                                <a href="{{ route('deshabilitar.turno', $data->id, $servicio->id) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Deshabilitar Turno"><i class="fas fa-times"></i></a>
                            @else
                                <a href="{{ route('habilitar.turno', $data->id, $servicio->id) }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Habilitar Turno"><i class="fas fa-check"></i></a>
                            @endif
                            
                            <a href="#a" class="btn btn-sm btn-info editar_turno"
                                data-turno="{{ $data->turno }}"
                                data-url="{{ route('editar.turno', $data->id, $servicio->id) }}"
                                data-toggle="tooltip" data-placement="top" title="Editar Turno"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('eliminar.turno', $data->id) }}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Elimimnar Turno"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="registrar_turno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Turno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('crear.turno', $servicio->id) }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Turno</label>
                        <input type="text" name="turno" required class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editar_turno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Turno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="form_editar_turno">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Turno</label>
                        <input type="text" name="turno" id="turno" required class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('footer')