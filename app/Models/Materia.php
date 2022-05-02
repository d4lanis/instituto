<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Materia extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = ['id','tipo_materia_id','categoria_materia_id','nombre','descripcion','lugares','duracion','calificacion_minima', 'grupo_id'];
    protected $dates = ['created_at','updated_at','deleted_at'];

    public function tipo_materia() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'tipo_materia_id');
    }

    public function categoria_materia() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'categoria_materia_id');
    }

    public function plan_de_estudios() {
        return $this->hasOne('App\Models\PlanDeEstudio', 'id', 'plan_de_estudios_id');
    }

}