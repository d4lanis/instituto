<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';

    public function items() {
        return $this->hasMany('App\Models\Municipio','estado_id', 'clave');
    }
}
