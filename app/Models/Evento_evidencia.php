<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento_evidencia extends Model
{
    protected $dates = ['created_at','updated_at','deleted_at'];

    public function evidencia_evento() {
        return $this->hasOne('App\Models\Evento', 
                'evento_id','id' );
    }
}
