@include('header')
<div class="container">
    <h4 class="mb-4">
        Listado de Usuarios
        <button class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#registrar_usuario">Registrar Usuario</button>
    </h4>
    
    @if ($errors->has('email'))
        <p class="text-danger">{{ $errors->first('email') }}</p>
    @endif
    @if ($errors->has('nombre'))
        <p class="text-danger">{{ $errors->first('nombre') }}</p>
    @endif
    @if ($errors->has('apellido'))
        <p class="text-danger">{{ $errors->first('apellido') }}</p>
    @endif
    @if ($errors->has('documento'))
        <p class="text-danger">{{ $errors->first('documento') }}</p>
    @endif
    @if ($errors->has('fecha_nacimiento'))
        <p class="text-danger">{{ $errors->first('fecha_nacimiento') }}</p>
    @endif
    @if ($errors->has('nivel'))
        <p class="text-danger">{{ $errors->first('nivel') }}</p>
    @endif
    <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Fecha de Nacimiento</th>
                    <th scope="col">Nivel</th>
                    <th scope="col">Color</th>
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
                        <td>{{ date('d/m/Y', strtotime($data->fecha_nacimiento)) }}</td>
                        <td>{{ $data->nivel}}</td>
                        <td><span style="background-color: {{ $data->color }}; padding: 3px; border-radius: 3px;">{{ $data->color }}</span></td>
                        <td>
                            @if ($data->status == 1)
                                <span class="text-success">Habilitado</span>
                            @else
                                <span class="text-danger">Deshabilitado</span>
                            @endif
                        </td>
                        <td>
                            @if ($data->status == 1)
                                <a href="{{ route('deshabilitar.usuario', $data->id) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Deshabilitar Usuario"><i class="fas fa-times"></i></a>
                            @else
                                <a href="{{ route('habilitar.usuario', $data->id) }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Habilitar Usuario"><i class="fas fa-check"></i></a>
                            @endif
                            
                            <a href="#a" class="btn btn-sm btn-info editar_usuario"
                                data-nombre="{{ $data->nombre }}"
                                data-apellido="{{ $data->apellido }}"
                                data-documento="{{ $data->documento }}"
                                data-email="{{ $data->email }}"
                                data-email="{{ $data->email }}"
                                data-nivel="{{ $data->nivel }}"
                                data-color="{{ $data->color }}"
                                data-fecha_nacimiento="{{ date('d/m/Y', strtotime($data->fecha_nacimiento)) }}"
                                data-url="{{ route('editar.usuario', $data->id) }}"
                                data-toggle="tooltip" data-placement="top" title="Editar Usuario"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('eliminar.usuario', $data->id) }}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Elimimnar Usuario"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="registrar_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('crear.usuario') }}" method="post">
                <div class="modal-body">
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
                        <input type="text" name="fecha_nacimiento" required class="form-control datepicker">
                    </div>
                    <div class="form-group">
                        <label>Nivel</label>
                        <select name="nivel" required class="form-control">
                            <option value="">Seleccione</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Ingeniero">Ingeniero</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Clave</label>
                        <input type="password" name="password" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Color</label>
                        <input type="color" name="color" required class="form-control">
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
<div class="modal fade" id="editar_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="form_editar_usuario">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" id="nombre" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" name="apellido" id="apellido" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Documento</label>
                        <input type="text" name="documento" id="documento" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="email" name="email" id="email" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Fecha de Nacimiento</label>
                        <input type="text" name="fecha_nacimiento" id="fecha_nacimiento" required class="form-control datepicker">
                    </div>
                    <div class="form-group">
                        <label>Nivel</label>
                        <select name="nivel" id="nivel" required class="form-control">
                            <option value="">Seleccione</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Ingeniero">Ingeniero</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Clave</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Color</label>
                        <input type="color" name="color" id="color" required class="form-control">
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