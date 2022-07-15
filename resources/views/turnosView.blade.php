@include('header')
<div class="container">
    <h4 class="mb-4">
        Hola  {{ $user_data->nombre }}, selecciona los turnos a los que quieras asignarte.
    </h4>
    
    <div class="btn-group">
        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Seleccione el Servicio
        </button>
        <div class="dropdown-menu">
            @foreach($servicios as $servicio_data)
                <a class="dropdown-item" href="{{ route('servicio.turnos.semana', ['id_servicio' => $id_servicio, 'semana' => date('W')]) }}">{{ $servicio_data->servicio }}</a>
            @endforeach
        </div>
    </div>
    @if (!empty($servicio))
        <div class="btn-group">
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Seleccione la Semana
            </button>
            <div class="dropdown-menu">
                @for ($i = date('W'); $i < date('W')+5; $i++)
                    <a class="dropdown-item" href="{{ route('servicio.turnos.semana', ['id_servicio' => $servicio->id, 'semana' => $i]) }}">Semana {{ $i }} del {{ date('Y') }}</a>
                @endfor
            </div>
        </div>
    @endif

    <hr>
    <h5>Servicio: {{ (!empty($servicio)) ? $servicio->servicio : 'No seleccionado' }}</h5>

    @if (!empty($servicio))
        <h5>Semana: {{ (!empty($semana)) ? $semana.' del '.date('Y') : 'No seleccionada' }}</h5>
        
    @endif
    @if($id_servicio != 0 && $semana != 0)
        <h5>Turnos: </h5>
        <br>
    @endif
    <form action="{{ route('obtener.turnos', ['id_servicio' => $id_servicio, 'semana' => $semana]) }}" method="post">
        @csrf
        <div class="row">
            @foreach($dias_turnos as $key => $value)
                <div class="col-md-4">
                    <table class="table table-bordered">
                        <tr class="text-center">
                            <td colspan="2"><b>{{ $dias_semana[date('w', strtotime(strtotime($key)))].' '.date('d/m/Y', strtotime($key)) }}</b></td>
                        </tr>
                        @if(!empty($value))
                            @php
                                $count = 0;
                            @endphp
                            @foreach($value as $turno)
                                <tr>
                                    <td>{{ $turno->hora }}</td>
                                    <td>
                                        @if(empty($turno->nombre))
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="turno{{ $turno->id }}" name="turnos_seleccionados[]" value="{{ $turno->id }}">
                                                <label class="form-check-label" for="turno{{ $turno->id }}">
                                                    Seleccionar este turno
                                                </label>
                                            </div>
                                        @else
                                            <span style="
                                            background-color: {{ $turno->color  }};
                                            width: 20px;
                                            height: 20px;
                                            border-radius: 3px;
                                            display: inline-block;
                                            vertical-align: sub;
                                            margin-right: 5px;"></span>
                                            {{ $turno->nombre.' '.$turno->apellido  }}
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $count++;
                                @endphp
                            @endforeach
                            @if($count == 0)
                                <tr>
                                    <td colspan="2">No hay turnos para este dia</td>
                                </tr>
                            @endif
                        @endif
                    </table>
                </div>
            @endforeach
        </div>
        @if($id_servicio != 0 && $semana != 0)
            <br><br> 
            <div class="row">
                <div class="col-12 text-center">
                    <button class="btn btn-success" type="submit">Obtener Turnos</button>
                </div>
            </div>
            <br><br><br>
        @endif
    </form>
</div>
@include('footer')