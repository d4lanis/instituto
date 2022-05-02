<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cambio extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = ['persona_id','motivo_cambio_id','fecha_cambio','puesto_id','puesto_nuevo_id',
    'acta_pdf'];
    protected $dates = ['created_at','updated_at','deleted_at','fecha_cambio'];

  
    protected $table = "cambios";
    protected $appends = ["nombre_completo"];

   
    public function getNombreCompletoAttribute(){
    	return $this->persona->fullname;
    }


    public function motivo_cambio() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'motivo_cambio_id');
    }
   
    public function puesto() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'puesto_id');
    }

    public function puesto_nuevo() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'puesto_nuevo_id');
    }

    public function persona() {
        return $this->hasOne('App\Models\Persona', 'id', 'persona_id');
    }
}
