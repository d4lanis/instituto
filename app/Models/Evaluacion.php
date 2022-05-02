<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluacion extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = ['persona_id','tipo_evaluacion_id','duracion','fecha_resultado','resultado_id',
    'tiempo_de_validez','observaciones'];
    protected $dates = ['created_at','updated_at','deleted_at','fecha_resultado'];

  
    protected $table = "evaluacions";

   
  

    public function tipo_evaluacion() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'tipo_evaluacion_id');
    }
   
    public function resultado() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'resultado_id');
    }

    public function persona() {
        return $this->hasOne('App\Models\Persona', 'id', 'persona_id');
    }
  
}
