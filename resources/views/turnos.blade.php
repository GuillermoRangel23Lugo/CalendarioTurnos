@include('header')
<div class="container">
    <h4 class="mb-4">
        Listado de Servicios
        <button class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#registrar_servicio">Registrar Servicio</button>
    </h4>
    
    @if ($errors->has('servicio'))
        <p class="text-danger">{{ $errors->first('servicio') }}</p>
    @endif
    <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Servicio</th>
                    <th scope="col">Status</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($servicios as $data)
                    <tr>
                        <td>1</td>
                        <td>{{ $data->servicio }}</td>
                        <td>
                            @if ($data->status == 1)
                                <span class="text-success">Habilitado</span>
                            @else
                                <span class="text-danger">Deshabilitado</span>
                            @endif
                        </td>
                        <td>
                            @if ($data->status == 1)
                                <a href="{{ route('deshabilitar.servicio', $data->id) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Deshabilitar Servicio"><i class="fas fa-times"></i></a>
                            @else
                                <a href="{{ route('habilitar.servicio', $data->id) }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Habilitar Servicio"><i class="fas fa-check"></i></a>
                            @endif
                            
                            <a href="{{ route('turnos.servicio', $data->id) }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Turnos"><i class="fas fa-clock"></i></a>
                            <a href="#a" class="btn btn-sm btn-info editar_servicio"
                                data-servicio="{{ $data->servicio }}"
                                data-url="{{ route('editar.servicio', $data->id) }}"
                                data-toggle="tooltip" data-placement="top" title="Editar Servicio"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('eliminar.servicio', $data->id) }}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Elimimnar Servicio"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="registrar_servicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('crear.servicio') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Servicio</label>
                        <input type="text" name="servicio" required class="form-control">
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
<div class="modal fade" id="editar_servicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="form_editar_servicio">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Servicio</label>
                        <input type="text" name="servicio" id="servicio" required class="form-control">
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