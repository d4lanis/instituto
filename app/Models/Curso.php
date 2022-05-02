<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = ['plan_estudio_id','nivel_escolar_id','nombre','descripcion','fecha_inicio','fecha_termino','oficio_numero','oficio_fecha','kardex_fecha','status_id'];
    protected $dates = ['created_at','updated_at','deleted_at','fecha_inicio','fecha_termino','oficio_fecha','kardex_fecha'];
    protected $table = "cursos";

    public function planes() {
        return $this->hasOne('App\Models\PlanEstudio', 
        		'id','plan_estudio_id' );
    }

    public function salonClases() {
        return $this->hasMany('App\Models\SalonClase', 
        		'curso_id','id' );
    }

    public function alumnos() {
        return $this->hasMany('App\Models\CursoAlumno', 
                'curso_id','id' );
    }

    public function evidencias() {
        return $this->hasMany('App\Models\Evidencia', 
                'curso_id','id' );
    }



}
