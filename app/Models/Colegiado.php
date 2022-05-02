<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Colegiado extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = ['numero_oficio','fecha_solicitud','motivo','solicitud','respuesta','resultado','notas'];
    protected $dates = ['created_at','updated_at','deleted_at','fecha_solicitud'];
    protected $table = "colegiados";


    public function colegiado() {
        return $this->hasOne('App\Models\Documento', 'id', 'id');
    }

}
