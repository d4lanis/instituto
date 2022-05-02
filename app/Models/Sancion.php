<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sancion extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = ['origen_queja_id','tipo_queja_id','folio_interno','asunto','tipo_sancion_id',
    'estado_sancion_id','fecha_inicio','fecha_termino','notas','acta_pdf','persona_id'];
    protected $dates = ['created_at','updated_at','deleted_at','fecha_inicio', 'fecha_termino'];

  


    public function origen_queja() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'origen_queja_id');
    }
    public function tipo_queja() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'tipo_queja_id');
    }

    public function tipo_sancion() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'tipo_sancion_id');
    }

    public function estado_sancion() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'estado_sancion_id');
    }

    public function persona() {
        return $this->hasOne('App\Models\Persona', 'id', 'persona_id');
    }
}
