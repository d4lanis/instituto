<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipios';

    public function items() {
        return $this->hasMany('App\Models\Localidad','municipio_id', 'clave');
    }
}
