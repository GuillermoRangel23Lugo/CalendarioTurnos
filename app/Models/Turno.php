<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
 
class Turno extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'turnos';

    public function get_all(){
        $turnos = DB::table($this->table)
        ->select('turnos.*','users.nombre','users.apellido','users.documento','users.color')
        ->leftJoin('users', 'users.id', '=', 'turnos.id_usuario')->get();
        return $turnos;
    }

    public function get_by_id_servicio($id_servicio){
        $turnos = DB::table($this->table)
        ->select('turnos.*','users.nombre','users.apellido','users.documento','users.color')
        ->leftJoin('users', 'users.id', '=', 'turnos.id_usuario')
        ->where('id_servicio', $id_servicio)->get();
        return $turnos;
    }

    public function get_by_id_servicio_and_fecha($id_servicio,$fecha){
        $turnos = DB::table($this->table)
        ->select('turnos.*','users.nombre','users.apellido','users.documento','users.color')
        ->leftJoin('users', 'users.id', '=', 'turnos.id_usuario')
        ->where('id_servicio', $id_servicio)
        ->where('fecha', 'like', $fecha . '%')
        ->get();
        return $turnos;
    }

    public function get_by_id_day($fecha){
        $turnos = DB::table($this->table)
        ->select('turnos.*','users.nombre','users.apellido','users.documento','users.color')
        ->leftJoin('users', 'users.id', '=', 'turnos.id_usuario')->where('fecha', $fecha)->get();
        return $turnos;
    }

    public function crear($data){
        DB::table($this->table)->insert($data);
    }

    public function actualizar($data, $id){
        DB::table($this->table)
        ->where('id', $id)
        ->update($data);
    }

    public function eliminar($id){
        DB::table($this->table)
        ->where('id', $id)
        ->delete();
    }

}