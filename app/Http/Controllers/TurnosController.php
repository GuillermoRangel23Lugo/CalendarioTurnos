<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use App\Models\Servicio;
use App\Models\Turno;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TurnosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $turno, $servicio, $user_data;

    public function __construct()
    {
        $this->middleware('auth');
        if(!Auth::check()){
            return redirect("login")->with('message', 'You are not allowed to access');
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id_servicio)
    {
        $this->turno = new Turno();
        $this->servicio = new Servicio();
        $servicio = $this->servicio->get_by_id($id_servicio);
        $turnos = $this->turno->get_by_id_servicio($id_servicio);
        $usuarios = DB::table('users')->where('status', 1)->get();
        return view('turnos', ['turnos' => $turnos, 'servicio' => $servicio, 'usuarios' => $usuarios]);
    }

    public function turnosView(Request $request, $id_servicio = 0, $semana = 0){
        $id = Auth::user()->id;
        $this->user_data = DB::table('users')->where('id', $id)->first();
        
        $this->turno = new Turno();
        $this->servicio = new Servicio();
        $servicios = $this->servicio->get_all_hab();
        $servicio = [];
        $turnos = [];
        if($id_servicio != 0){
            $servicio = $this->servicio->get_by_id($id_servicio);
            $turnos = $this->turno->get_by_id_servicio($id_servicio);
        }

        $dias_turnos = [];
        if($id_servicio != 0 && $semana != 0){
            $dias = (($semana-1)*7)+1;
            for($i = 1; $i <= 7; $i++){
                $dia = date('Y-m-d', strtotime(date('Y').'-01-01 00:00:00 +'.($dias+$i).' days'));
                $dias_turnos[$dia] = $this->turno->get_by_id_servicio_and_fecha($id_servicio, $dia);
            }
        }

        $dias_semana = [0 => 'Domingo', 1 => 'Lunes', 2 => 'Martes', 3 => 'Miercoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sabado'];

        return view('turnosView', ['servicios' => $servicios, 'user_data' => $this->user_data, 'servicio' => $servicio, 'turnos' => $turnos, 'semana' => $semana, 'dias_turnos' => $dias_turnos, 'dias_semana' => $dias_semana]);
    }

    public function obtenerTurnos(Request $request, $id_servicio, $semana){
        $data = $request->all();
        foreach($data['turnos_seleccionados'] as $turno){
            $this->turno->actualizar([
                'id_usuario' => Auth::user()->id,
            ], $turno->id);
        }
        return redirect()->route("turnos.servicio", ['id_servicio' => $id_servicio, 'semana' => $semana])->with('message', 'Turno obtenidos.');
    }
    
    public function crearTurno(Request $request, $id_servicio){
        $this->turno = new Turno();
        $request->validate([
            'hora' => 'required',
            'id_usuario' => 'required',
            'fecha' => 'required',
        ]);
           
        $data = $request->all();
        $this->turno->crear([
            'hora' => $data['hora'],
            'id_usuario' => $data['id_usuario'],
            'fecha' => date('Y-m-d', strtotime(str_replace('/', '-', $data['fecha']))),
            'id_servicio' => $id_servicio,
            'status' => 1,
        ]);
        return redirect()->route("turnos.servicio", $id_servicio)->with('message', 'Turno registrado.');
    }
    
    public function editarTurno(Request $request, $id, $id_servicio){
        $this->turno = new Turno();
        $request->validate([
            'hora' => 'required',
            'id_usuario' => 'required',
            'fecha' => 'required',
        ]);
           
        $data = $request->all();
        $this->turno->actualizar([
            'hora' => $data['hora'],
            'id_usuario' => $data['id_usuario'],
            'fecha' => date('Y-m-d', strtotime(str_replace('/', '-', $data['fecha']))),
        ], $id);
        return redirect()->route("turnos.servicio", $id_servicio)->with('message', 'Turno editado.');
    }

    public function eliminarTurno(Request $request, $id, $id_servicio){
        $this->turno = new Turno();
        $this->turno->eliminar($id);
        return redirect()->route("turnos.servicio", $id_servicio)->with('message', 'Turno eliminado.');
    }
}
