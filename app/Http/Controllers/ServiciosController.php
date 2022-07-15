<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiciosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $servicio;

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
    public function index()
    {
        $this->servicio = new Servicio();
        $servicios = $this->servicio->get_all();
        return view('servicios', ['servicios' => $servicios]);
    }
    
    public function crearServicio(Request $request){
        $this->servicio = new Servicio();
        $request->validate([
            'servicio' => 'required',
        ]);
           
        $data = $request->all();
        $this->servicio->crear([
            'servicio' => $data['servicio'],
            'status' => 1,
        ]);
        return redirect("servicios")->with('message', 'Servicio registrado.');
    }
    
    public function habilitarServicio(Request $request, $id){
        $this->servicio = new Servicio();
        $this->servicio->actualizar([
            'status' => 1,
        ], $id);
        
        return redirect("servicios")->with('message', 'Servicio habilitado.');
    }
    
    public function deshabilitarServicio(Request $request, $id){
        $this->servicio = new Servicio();
        $this->servicio->actualizar([
            'status' => 0,
        ], $id);

        return redirect("servicios")->with('message', 'Servicio deshabilitado.');
    }
    
    public function editarServicio(Request $request, $id){
        $this->servicio = new Servicio();
        $request->validate([
            'servicio' => 'required',
        ]);
           
        $data = $request->all();
        $this->servicio->actualizar([
            'servicio' => $data['servicio'],
        ], $id);
        return redirect("servicios")->with('message', 'Servicio editado.');
    }

    public function eliminarServicio(Request $request, $id){
        $this->servicio = new Servicio();
        $this->servicio->eliminar($id);
        return redirect("servicios")->with('message', 'Servicio eliminado.');
    }
}
