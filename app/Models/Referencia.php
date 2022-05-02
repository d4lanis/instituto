<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Referencia extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = [];
    protected $dates = ['created_at','updated_at','deleted_at'];
    protected $table = "referencias";
    protected $appends = ["fullnamereferencia"];

    public function getFullnamereferenciaAttribute(){
        return implode(", ",[ implode(" ",[$this->paterno_referencia,$this->materno_referencia]) , $this->nombre_referencia]); 
    }
   
    public function sexo() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'sexo_id');
    }

    public function parentesco() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'parentesco_id');
    }

    public function contacto_referencia() {
        return $this->hasOne('App\Models\ContactoReferencia', 'referencia_id', 'id');
    }

    public function domicilio_referencia() {
        return $this->hasOne('App\Models\DomicilioReferencia', 'referencia_id', 'id');
    }

  
    public function persona() {
        return $this->hasOne('App\Models\Persona', 'id', 'persona_id');
    }

}
