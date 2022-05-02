<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Filiacion extends Model
{
    use SoftDeletes;
	protected $guarded = [];
    protected $fillable = ['complexion_id','color_piel_id','cantidad_de_cabello_id','color_de_cabello_id',
    'forma_de_cabello_id','color_de_ojos_id','size_de_ojos_id','size_de_nariz_id',
    'size_de_boca_id','forma_de_cara_id','persona_id'];
    protected $dates = ['created_at','updated_at','deleted_at'];

  

    public function complexion() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'complexion_id')
                    ->withDefault(['name' => 'Sin Dato']);
    }

    public function color_piel() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'color_piel_id')->withDefault([
            'name' => 'Sin Dato'
        ]);
    }

    public function cantidad_cabello() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'cantidad_de_cabello_id')
                    ->withDefault(['name' => 'Sin Dato']);
    }

    public function color_cabello() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'color_de_cabello_id')
                    ->withDefault(['name' => 'Sin Dato']);
    }

    public function forma_cabello() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'forma_de_cabello_id')
                    ->withDefault(['name' => 'Sin Dato']);
    }

    public function color_ojos() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'color_de_ojos_id')
                    ->withDefault(['name' => 'Sin Dato']);
    }

    public function size_ojos() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'size_de_ojos_id')
                    ->withDefault(['name' => 'Sin Dato']);
    }

    public function size_nariz() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'size_de_nariz_id')
                    ->withDefault(['name' => 'Sin Dato']);
    }

    public function size_boca() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'size_de_boca_id')
                    ->withDefault(['name' => 'Sin Dato']);
    }

    public function forma_cara() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'forma_de_cara_id')
                    ->withDefault(['name' => 'Sin Dato']);
    }
}


