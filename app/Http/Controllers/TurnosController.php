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
    protected $turno, $servicio;

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
