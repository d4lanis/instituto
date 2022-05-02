<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Escolaridad extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = [];
    protected $dates = ['created_at','updated_at','deleted_at'];
    protected $table = "escolaridads";

    public function nivel_escolar() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'nivel_escolar_id');
    }

    public function estatus() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'estatus_id');
    }

    public function persona() {
        return $this->hasOne('App\Models\Persona', 'id', 'persona_id');
    }
  
    public function aulas() {
        return $this->hasMany('App\Models\SalonClaseAlumno', 'id', 'curso_id');
        
    }



}
