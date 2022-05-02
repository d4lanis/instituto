<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DomicilioReferencia extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = ['calle_referencia','colonia_referencia','numero_exterior_referencia','codigo_postal_referencia',
    'estado_referencia_id','municipio_referencia_id','poblacion_referencia_id','referencia_id'];
    protected $dates = ['created_at','updated_at','deleted_at'];
}
