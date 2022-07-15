<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::user()->id;
        $this->user_data = DB::table('users')->where('id', $id)->first();
        if($this->user_data->nivel == 'Ingeniero'){
            return redirect()->route("turnos")->with('message', 'No tienes acceso');
        }
        $usuarios = DB::table('users')->get();
        return view('usuarios', ['usuarios' => $usuarios]);
    }
    
    public function crearUsuario(Request $request){
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'documento' => 'required',
            'fecha_nacimiento' => 'required',
            'nivel' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        if(isset($data['password']) && !empty($data['password'])){
            $data_create = [
                'nombre' => $data['nombre'],
                'apellido' => $data['apellido'],
                'documento' => $data['documento'],
                'fecha_nacimiento' => date('Y-m-d', strtotime(str_replace('/', '-', $data['fecha']))),
                'nivel' => $data['nivel'],
                'email' => $data['email'],
                'color' => $data['color'],
                'password' => Hash::make($data['password'])
            ];
        }
        else{
            $data_create = [
                'nombre' => $data['nombre'],
                'apellido' => $data['apellido'],
                'documento' => $data['documento'],
                'fecha_nacimiento' => date('Y-m-d', strtotime(str_replace('/', '-', $data['fecha']))),
                'nivel' => $data['nivel'],
                'email' => $data['email'],
                'color' => $data['color'],
            ];
        }
        User::create();
        return redirect("usuarios")->with('message', 'Usuario registrado.');
    }
    
    public function habilitarUsuario(Request $request, $id){
        DB::table('users')
                ->where('id', $id)
                ->update(['status' => 1]);
        return redirect("usuarios")->with('message', 'Usuario habilitado.');
    }
    
    public function deshabilitarUsuario(Request $request, $id){
        DB::table('users')
                ->where('id', $id)
                ->update(['status' => 0]);
        return redirect("usuarios")->with('message', 'Usuario deshabilitado.');
    }
    
    public function editarUsuario(Request $request, $id){
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'documento' => 'required',
            'fecha_nacimiento' => 'required',
            'nivel' => 'required',
            'email' => 'required|email',
        ]);
           
        $data = $request->all();

        DB::table('users')
                ->where('id', $id)
                ->update([
                    'nombre' => $data['nombre'],
                    'apellido' => $data['apellido'],
                    'documento' => $data['documento'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'email' => $data['email'],
                    'nivel' => $data['nivel'],
                    'color' => $data['color'],
                    'fecha_nacimiento' => date('Y-m-d', strtotime($data['fecha_nacimiento'])),
                ]);
        return redirect("usuarios")->with('message', 'Usuario editado.');
    }

    public function eliminarUsuario(Request $request, $id){
        $usuario = DB::table('users')
        ->where('id', $id)
        ->delete();
        return redirect("usuarios")->with('message', 'Usuario eliminado.');
    }
}
