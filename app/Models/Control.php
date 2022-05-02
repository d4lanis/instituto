<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Control extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = ['persona_id','tipo_control_confianza_id','motivo_control_id',
    'duracion','numero_oficio','fecha_resultado','resultado_id',
    'vigencia','observaciones'];
    protected $dates = ['created_at','updated_at','deleted_at','fecha_resultado','vigencia','fecha_prueba_1',
'fecha_prueba_2','fecha_prueba_3','fecha_prueba_arma'];

  
    protected $table = "controls";

    public function motivo_control() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'motivo_control_id');
    }
  

    public function tipo_control() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'tipo_control_confianza_id');
    }
   
    public function resultado() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'resultado_id');
    }

    public function persona() {
        return $this->hasOne('App\Models\Persona', 'id', 'persona_id');
    }
}
