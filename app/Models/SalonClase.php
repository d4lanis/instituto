<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalonClase extends Model
{

    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = ['curso_id','materia_id','maestro_id','status'];
    protected $dates = ['created_at','updated_at','deleted_at'];
    protected $table ="salon_clases";
    protected $appends = ["readonly"];


    public function materia() {
        return $this->hasOne('App\Models\Materia', 'id','materia_id' );
    }

    public function maestro() {
        return $this->hasOne('App\Models\Maestro', 'id','maestro_id' );
    }

    public function alumnos() {
        return $this->hasMany('App\Models\SalonClaseAlumno', 'salon_clase_id','id' );
    }

    public function getReadonlyAttribute(){
        return $this->status > 0 ? "readonly disabled" : "";
    }

}
