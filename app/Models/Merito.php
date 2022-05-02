<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merito extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = ['acta_pdf','merito_por_id','tipo_merito_id','folio_interno',
    'fecha_reconocimiento','notas','persona_id'];
    protected $dates = ['created_at','updated_at','deleted_at','fecha_reconocimiento'];
    protected $table = "meritos";

    public function tipo_merito() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'tipo_merito_id');
    }

    public function merito_por() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'merito_por_id');
    }

    public function persona() {
        return $this->hasOne('App\Models\Persona', 'id', 'persona_id');
    }

}
