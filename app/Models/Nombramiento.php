<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nombramiento extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = ['persona_id','nombre_cargo_grado','fecha_inicio',
    'area_adscripcion','promedio','nombre_documento_certifica',
    'documento_pdf'];
    protected $dates = ['created_at','updated_at','deleted_at','fecha_inicio'];
    protected $table = "nombramientos";

    public function persona() {
        return $this->hasOne('App\Models\Persona', 'id', 'persona_id');
    }
}
