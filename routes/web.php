<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');


Route::get('usuarios', 'App\Http\Controllers\UsuariosController@index')->name('usuarios');
Route::post('crear-usuario', 'App\Http\Controllers\UsuariosController@crearUsuario')->name('crear.usuario');
Route::get('calendario', 'App\Http\Controllers\CalendarioController@index')->name('calendario');