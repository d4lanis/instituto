<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documento extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = ['numero_seguro','no_habilitacion','solicitud_empleo','acta_de_nacimiento',
    'rfc','curp','cer_secundaria','cer_bachillerato','cer_tecnico','cer_profesional','comentario','persona_id',
    'foto_perfil','huellas','comentario'];
    protected $dates = ['created_at','updated_at','deleted_at'];

    public function profileimage()
    {

        $pathseguro = ($this->image) ?  $this->image : 'profile.png';
        return '/storage/' . $pathseguro;
    }




}
