<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalonClaseAlumno extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = ['salon_clase_id','curso_alumno_id','calificacion','faltas','extra'];
    protected $dates = ['created_at','updated_at','deleted_at'];
    protected $table ="salon_clase_alumnos";
    protected $appends = ["nombre_alumno", "readonly"];

  	public function curso_alumno() {
        return $this->hasOne('App\Models\CursoAlumno', 'id','curso_alumno_id' );
    }

    public function salon_materia() {
        return $this->hasOne('App\Models\SalonClase', 'id','salon_clase_id' );
    }

    public function curso() {
        return $this->hasOne('App\Models\Curso', 'id', 'curso_id');
    }
    public function getNombreAlumnoAttribute(){
    	return $this->curso_alumno->alumno->fullname;
    }


    public function getReadonlyAttribute(){
        return $this->status > 0 ? "readonly disabled" : "";
    }
}
