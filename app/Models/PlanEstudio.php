<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanEstudio extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = ['nombre','descripcion'];
    protected $dates = ['created_at','updated_at','deleted_at'];
    protected $table ="planestudios";

    public function materias() {
        return $this->hasMany('App\Models\PlanEstudioMateria', 
        		'plan_estudio_id','id' );
    }

    
}
