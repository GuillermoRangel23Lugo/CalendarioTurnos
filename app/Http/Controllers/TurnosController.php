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
        return view('turnos', ['turnos' => $turnos, 'servicio' => $servicio]);
    }
    
    public function crearTurno(Request $request){
        $this->turno = new Turno();
        $request->validate([
            'turno' => 'required',
        ]);
           
        $data = $request->all();
        $this->turno->crear([
            'turno' => $data['turno'],
            'status' => 1,
        ]);
        return redirect("turnos")->with('message', 'Turno registrado.');
    }
    
    public function habilitarTurno(Request $request, $id){
        $this->turno = new Turno();
        $this->turno->actualizar([
            'status' => 1,
        ], $id);
        
        return redirect("turnos")->with('message', 'Turno habilitado.');
    }
    
    public function deshabilitarTurno(Request $request, $id){
        $this->turno = new Turno();
        $this->turno->actualizar([
            'status' => 0,
        ], $id);

        return redirect("turnos")->with('message', 'Turno deshabilitado.');
    }
    
    public function editarTurno(Request $request, $id){
        $this->turno = new Turno();
        $request->validate([
            'turno' => 'required',
        ]);
           
        $data = $request->all();
        $this->turno->actualizar([
            'turno' => $data['turno'],
        ], $id);
        return redirect("turnos")->with('message', 'Turno editado.');
    }

    public function eliminarTurno(Request $request, $id){
        $this->turno = new Turno();
        $this->turno->eliminar($id);
        return redirect("turnos")->with('message', 'Turno eliminado.');
    }
}
