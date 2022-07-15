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
Route::get('habilitar-usuario/{id}', 'App\Http\Controllers\UsuariosController@habilitarUsuario')->name('habilitar.usuario');
Route::get('deshabilitar-usuario/{id}', 'App\Http\Controllers\UsuariosController@deshabilitarUsuario')->name('deshabilitar.usuario');
Route::get('eliminar-usuario/{id}', 'App\Http\Controllers\UsuariosController@eliminarUsuario')->name('eliminar.usuario');
Route::post('editar-usuario/{id}', 'App\Http\Controllers\UsuariosController@editarUsuario')->name('editar.usuario');
Route::post('crear-usuario', 'App\Http\Controllers\UsuariosController@crearUsuario')->name('crear.usuario');
Route::get('calendario', 'App\Http\Controllers\CalendarioController@index')->name('calendario');


Route::get('servicios', 'App\Http\Controllers\ServiciosController@index')->name('servicios');
Route::get('habilitar-servicio/{id}', 'App\Http\Controllers\ServiciosController@habilitarServicio')->name('habilitar.servicio');
Route::get('deshabilitar-servicio/{id}', 'App\Http\Controllers\ServiciosController@deshabilitarServicio')->name('deshabilitar.servicio');
Route::get('eliminar-servicio/{id}', 'App\Http\Controllers\ServiciosController@eliminarServicio')->name('eliminar.servicio');
Route::post('editar-servicio/{id}', 'App\Http\Controllers\ServiciosController@editarServicio')->name('editar.servicio');
Route::post('crear-servicio', 'App\Http\Controllers\ServiciosController@crearServicio')->name('crear.servicio');


Route::get('servicio/{id}/turnos', 'App\Http\Controllers\TurnosController@index')->name('turnos.servicio');
Route::get('eliminar-turno/{id}/{id_servicio}', 'App\Http\Controllers\TurnosController@eliminarTurno')->name('eliminar.turno');
Route::post('editar-turno/{id}/{id_servicio}', 'App\Http\Controllers\TurnosController@editarTurno')->name('editar.turno');
Route::post('crear-turno/{id_servicio}', 'App\Http\Controllers\TurnosController@crearTurno')->name('crear.turno');


Route::get('turnos', 'App\Http\Controllers\TurnosController@turnosView')->name('turnos');
Route::get('turnos/{id_servicio}', 'App\Http\Controllers\TurnosController@turnosView')->name('servicio.turnos');
Route::get('turnos/{id_servicio}/{semana}', 'App\Http\Controllers\TurnosController@turnosView')->name('servicio.turnos.semana');