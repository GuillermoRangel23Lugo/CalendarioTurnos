<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
 
class Servicio extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'servicios';

    public function get_all(){
        $servicios = DB::table($this->table)->get();
        return $servicios;
    }

    public function get_all_hab(){
        $servicios = DB::table($this->table)->where('status', 1)->get();
        return $servicios;
    }
    
    public function get_by_id($id){
        $servicio = DB::table($this->table)->where('id', $id)->first();
        return $servicio;
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