<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use Config;

class Catalogo extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = ['name','parent_id'];
    protected $dates = ['created_at','updated_at','deleted_at'];

    const PAIS = 'pais';
    const MEXICO = 154;
    const SEXO = 'sexo';
    const TIPO_SANGRE = 'tipo_sangre';
    const ESTADO_CIVIL = 'estado_civil';
    const ESCOLARIDAD = 'escolaridad';
    const SI_NO = 'si_no';
    const DIAS_SEMANA = 'dias_semana';
    const TIPO_MATERIAS = 'tipo_materias';
    const CATEGORIA_MATERIAS = 'categoria_materias';
    const DELEGACIONES = 'delegaciones';
    const CATEGORIA_PUESTOS = 'categoria_puestos';
    const DOCUMENTOS = 'documentos';
    const PRUEBA_CONFIANZA = 'prueba_confianza';
    const COMPLEXION ='complexion';
    const COLOR_PIEL ='color_piel';
    const CANTIDAD_CABELLO ='cantidad_cabello';
    const COLOR_CABELLO ='color_cabello';
    const FORMA_CABELLO ='forma_cabello';
    const COLOR_OJOS ='color_ojos';
    const SIZE_OJOS ='size_ojos';
    const SIZE_NARIZ ='size_nariz';
    const SIZE_BOCA ='size_boca';
    const FORMA_CARA ='forma_cara';
    const NIVEL_ESCOLAR ='nivel_escolar';
    const ESTATUS_ESCOLAR ='estatus_escolar';
    const MERITO_POR ='merito_por';
    const TIPO_MERITO ='tipo_merito';
    const ORIGEN_QUEJA ='origen_queja';
    const TIPO_QUEJA ='tipo_queja';
    const TIPO_SANCION ='tipo_sancion';
    const ESTADO_SANCION ='estado_sancion';
    const PARENTESCO ='parentesco';
    const TIPO_EVALUACION = 'tipo_evaluacion';
    const FOTOGRAFIA = 'fotografia';
    const STATUS_PERSONAL = 'status_personal';
    const RESULTADO_DESEMPENO = 'resultado_desempeno';
    const CONTROL_CONFIANZA_RESULTADO = 'control_confianza_resultado';
    const STATUS_DOCUMENTAL = 'status_documental';
    const RESULTADO_DOCUMENTAL = 'resultado_documental';
    const RESULTADO_ARMA = 'resultado_arma';
    
    const MOTIVO_CAMBIO = 'motivo_cambio';
    const TIPO_BAJA = 'tipo_baja';
    const MOTIVO_BAJA = 'motivo_baja';
    const TIPO_ORGANO = 'tipo_organo';
    const EVALUACIONES = 'evaluaciones';
    const TIPO_CONTROL_CONFIANZA = 'tipo_control_confianza';
    const MOTIVO_CONTROL_CONFIANZA = 'motivo_control_confianza';



    public function scopeFind_by_name($query, $nombre_catalogo=null) {
        if (is_null($nombre_catalogo)) {
            return $query->whereNull('parent_id');
        }

        $query->whereRaw("LOWER(name) = '". strtolower($nombre_catalogo) . "'");
        return $query->where('name',ucwords($nombre_catalogo));
    }

    public function current_catalogo(){
        $result = "catalogos";
        if(!is_null($this->parent_id)){
            $result =  $this->parent->name;
        }
        return array('label'=>ucfirst($result),'parent_id'=>$this->parent_id);
    }    

    public function parent() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'parent_id');
    }

    public function items() {
        return $this->hasMany('App\Models\Catalogo','parent_id', 'id');
    }
}
