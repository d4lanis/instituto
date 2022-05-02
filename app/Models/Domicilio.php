<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domicilio extends Model
{
	use SoftDeletes;
	protected $guarded = [];
    protected $fillable = ['colonia','calle','numero_exterior','numero_interior','codigo_postal','localidad_id','municipio_id','estado_id','persona_id'];
    protected $dates = ['created_at','updated_at','deleted_at'];

    public function domicilioable(){
    	$this->morphTo();
    }

    public function localidad() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'localidad_id');
    }

    public function municipio() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'municipio_id');
    }

    public function estado() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'estado_id');
    }

    public function persona() {
        return $this->hasOne('App\Models\Persona', 'id', 'persona_id');
    }
}
