<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Baja extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = ['persona_id','tipo_baja_id','fecha_baja','motivo_baja_id',
    'acta_pdf'];
    protected $dates = ['created_at','updated_at','deleted_at','fecha_baja'];

  
    protected $table = "bajas";
    protected $appends = ["nombre_completo"];

   
    public function getNombreCompletoAttribute(){
    	return $this->persona->fullname;
    }


    public function tipo_baja() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'tipo_baja_id');
    }
   
    public function motivo_baja() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'motivo_baja_id');
    }

    public function persona() {
        return $this->hasOne('App\Models\Persona', 'id', 'persona_id');
    }
}
