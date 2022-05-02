<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evento extends Model
{
    use SoftDeletes;
    protected $guarded = [];
   
    protected $dates = ['created_at','updated_at','deleted_at','fecha_evento'];
    protected $table = "eventos";

    public function evidencias() {
        return $this->hasMany('App\Models\Evento_evidencia', 
                'evento_id','id' );
    }
}
