<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PlanEstudioMateria extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = ['materia_id','plan_estudio_id'];
    protected $dates = ['created_at','updated_at','deleted_at'];
    protected $table ="planestudiomaterias";

    public function materia() {
        return $this->hasOne('App\Models\Materia', 'id', 'materia_id');
    }
    
}
