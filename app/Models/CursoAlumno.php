<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CursoAlumno extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = ['curso_id','persona_id'];
    protected $dates = ['created_at','updated_at','deleted_at'];
    protected $table = "curso_alumnos";
  

    public function alumno() {
        return $this->hasOne('App\Models\Persona', 'id', 'persona_id');
    }

 

    public function aulas() {
        return $this->hasMany('App\Models\SalonClaseAlumno', 'id', 'curso_id');
        
    }
    public function salon() {
        return $this->hasOne('App\Models\SalonClase', 'id', 'curso_id');
    }

    public function salon_clases() {
        return $this->hasMany('App\Models\SalonClase', 'id', 'curso_id');
    }

    public function curso() {
        return $this->hasMany('App\Models\Curso', 'id', 'curso_id');
    }

  

}
