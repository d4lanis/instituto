<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Domicilio;
use App\Models\Documento;
use App\Models\Filiacion;
use App\Models\Escolaridad;
use App\Models\Referencia;
use App\Models\Contacto;
use App\Models\Merito;
use App\Models\Sancion;


class Persona extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable = ['numero_convocatoria','numero_empleado','nombre','paterno','materno','edad',
    'sexo_id','tipo_sanguineo_id','categoria_puestos_id',
    'status_id','rfc','curp','cuip','fecha_ingreso', 'fecha_nacimiento','adscripcion_id','cargo_puesto_id','estado_civil_id'];
    protected $dates = ['created_at','updated_at','deleted_at','fecha_ingreso', 'fecha_nacimiento'];

    protected $appends = ["fullname","modelo_domicilio","modelo_filiacion","escolaridad","referencia","merito"];


    public function documentos() {
        return $this->hasMany('App\Models\Documento', 'persona_id', 'id');
    }

    public function perfil() {
        return $this->hasOne('App\Models\Documento', 'persona_id', 'id');
    }

    public function categoria_puestos() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'categoria_puestos_id');
    }

    public function cargo_puesto() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'cargo_puesto_id');
    }

    public function status() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'status_id');
    }

    public function tipo_sanguineo() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'tipo_sanguineo_id');
    }
    public function estatus() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'estatus_id');
    }
    public function nivel_escolar() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'nivel_escolar_id');
    }

    public function sexo() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'sexo_id');
    }

    public function estado_civil() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'estado_civil_id');
    }

   
    
    public function getFullnameAttribute(){
        return implode(", ",[ implode(" ",[$this->paterno,$this->materno]) , $this->nombre]); 
    }

    public function domicilio() {
        return $this->hasOne('App\Models\Domicilio', 'persona_id', 'id');
    }

    public function filiacion() {
        return $this->hasOne('App\Models\Filiacion', 'persona_id', 'id');
    }

    public function estudios() {
        return $this->hasMany('App\Models\Escolaridad', 'persona_id', 'id');
    }

    public function referen() {
        return $this->hasOne('App\Models\Referencia', 'persona_id', 'id');
    }

    public function meritos() {
        return $this->hasMany('App\Models\Merito', 'persona_id', 'id');
    }

 

    public function sanciones() {
        return $this->hasMany('App\Models\Sancion', 'persona_id', 'id');
    }

    public function evaluaciones() {
        return $this->hasMany('App\Models\Evaluacion', 'persona_id', 'id');
    }

    public function cambios() {
        return $this->hasMany('App\Models\Cambio', 'persona_id', 'id');
    }

    public function nombramientos() {
        return $this->hasMany('App\Models\Nombramiento', 'persona_id', 'id');
    }

    public function bajas() {
        return $this->hasMany('App\Models\Baja', 'persona_id', 'id');
    }

    public function control() {
        return $this->hasMany('App\Models\Control', 'persona_id', 'id');
    }

    public function contacto() {
        return $this->hasOne('App\Models\Contacto', 'persona_id', 'id');
    }

    public function curso_persona() {
        return $this->hasMany('App\Models\CursoAlumno', 'persona_id', 'id');
    }

   

 


    public function getModeloDomicilioAttribute(){
    	$domicilio = $this->domicilio ?? new Domicilio;
    	return $domicilio;
    }

    public function getModeloFiliacionAttribute(){
    	$filiacion = $this->filiacion ?? new Filiacion;
    	return $filiacion;
    }

    public function getEscolaridadAttribute(){
        return new Escolaridad;
    }

    public function getReferenciaAttribute(){
        return new Referencia;
    }

    public function getMeritoAttribute(){
        return new Merito;
    }
    

    //filiacion
    public function complexion() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'complexion_id');
    }
    public function color_piel() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'color_piel_id');
    }
    public function cantidad_cabello() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'cantidad_cabello_id');
    }
    public function color_cabello() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'color_cabello_id');
    }
    public function forma_cabello() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'forma_cabello_id');
    }
    public function color_ojos() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'color_ojos_id');
    }
    public function size_ojos() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'size_ojos_id');
    }
    public function size_nariz() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'size_nariz_id');
    }
    public function size_boca() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'size_boca_id');
    }
    public function forma_cara() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'forma_cara_id');
    }

    
    //meritos
    public function merito_por() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'merito_por_id');
    }
    public function tipo_merito() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'tipo_merito_id');
    }

    //sanciones

    public function origen_queja() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'origen_queja_id');
    }
    public function tipo_queja() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'tipo_queja_id');
    }
    public function tipo_sancion() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'tipo_sancion_id');
    }
    public function estado_sancion() {
        return $this->hasOne('App\Models\Catalogo', 'id', 'estado_sancion_id');
    }

}
