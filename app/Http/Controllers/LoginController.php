<?php 
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller{  

    public function __construct(){
        $this->middleware('guest')->except('cerrar_sesion');
    }
    
    public function iniciar_sesion(Request $request){
        $request->validate([
            'correo' => 'required',
            'clave' => 'required'
        ]);

        $credenciales = $request->except(['_token']);

        $user = User::where('correo',$request->correo)->first();

        if (auth()->attempt($credenciales)) {
            return redirect()->route('home');
        }
        else{
            session()->flash('message', 'Credenciales incorrectas');
            return redirect()->back();
        }
    }

    public function cerrar_sesion(){
        \Auth::logout();
        return redirect()->route('home');
    }
}