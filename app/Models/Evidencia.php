<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Evidencia extends Model
{
    // use SoftDeletes;

    protected $dates = ['created_at','updated_at','deleted_at'];

    public function evidencia_curso() {
        return $this->hasOne('App\Models\Curso', 
                'curso_id','id' );
    }
}
