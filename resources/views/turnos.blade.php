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
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Ocupado por</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($turnos as $data)
                    <tr>
                        <td>1</td>
                        <td>{{ date('d/m/Y', strtotime($data->fecha)) }}</td>
                        <td>{{ $data->hora }}</td>
                        <td><span style="background-color: {{ $data->color  }}; width: 20px; height: 20px; border-radius: 3px; display: inline-block; vertical-align: sub; margin-right: 5px;"></span>{{ $data->nombre.' '.$data->apellido  }}</td>
                        <td>
                            <a href="#a" class="btn btn-sm btn-info editar_turno"
                                data-fecha="{{ date('d/m/Y', strtotime($data->fecha)) }}"
                                data-hora="{{ $data->hora }}"
                                data-id_usuario="{{ $data->id_usuario }}"
                                data-url="{{ route('editar.turno', ['id'=>$data->id, 'id_servicio'=>$servicio->id]) }}"
                                data-toggle="tooltip" data-placement="top" title="Editar Turno"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('eliminar.turno', ['id'=>$data->id, 'id_servicio'=>$servicio->id]) }}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Elimimnar Turno"><i class="fas fa-trash"></i></a>
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
                        <label>Fecha</label>
                        <input type="text" name="fecha" required class="form-control datepicker">
                    </div>
                    <div class="form-group">
                        <label>Hora</label>
                        <input type="text" name="hora" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Ocupado por</label>
                        <select name="id_usuario" class="form-control">
                            <option value="0">Seleccione</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->nombre }} {{ $usuario->apellido }}</option>
                            @endforeach
                        </select>
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
                        <label>Fecha</label>
                        <input type="text" name="fecha" id="fecha" required class="form-control datepicker">
                    </div>
                    <div class="form-group">
                        <label>Hora</label>
                        <input type="text" name="hora" id="hora" required class="form-control">
                    </div>
                        <label>Ocupado por</label>
                    <div class="form-group">
                        <select name="id_usuario" id="id_usuario" class="form-control">
                            <option value="0">Seleccione</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->nombre }} {{ $usuario->apellido }}</option>
                            @endforeach
                        </select>
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