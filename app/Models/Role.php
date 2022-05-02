<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Role extends \Spatie\Permission\Models\Role
{
	protected $guarded = [];
    protected $fillable = ['name'];    
    protected $dates = ['deleted_at'];
    protected $table = "roles";

    const SUPER_ADMIN = 'super_admin';
    const ADMIN = 'admin';
    const USER = 'user';
    const DIRECTOR = 'director';
    const INSTRUCTOR = 'instructor';
    const RECLUTAMIENTO = 'reclutamiento';
    const RECURSOS_HUMANOS = 'recursos_humanos';
    const ADMIN_GRUPO = 'admin_grupo';
	const CAPTURISTA = 'capturista';
	const PROGRAMADOR_CURSOS = 'programador_cursos';
	const C3 = 'c3';
	const SELECCIONADOR = 'seleccionador';
	const APROBADO_PUESTO_ACTUAL_C3 = 'aprobado_puesto_actual_c3';
	const APROBADO_PUESTO_ASPIRA_C3 = 'aprobado_puesto_aspira_c3';
	const APROBADO_RESTRICCIONES_PUESTO_ACTUAL_C3 = 'aprobado_restricciones_puesto_actual_c3';
	const APROBADO_RESTRICCIONES_PUESTO_ASPIRA_C3 = 'aprobado_restricciones_puesto_aspira_c3';
	const NO_APROBADO_PUESTO_ASPIRA_C3 = 'no_aprobado_puesto_actual_c3';
	const NO_APROBADO_PUESTO_ACTUAL_C3 = 'no_aprobado_puesto_aspira_c3';
	const ALUMNO = 'alumno';
	const ASPIRANTE = 'aspirante';
	const ACTIVO = 'activo';
	const CON_REQUISITOS = 'con_requisitos';
	const SIN_REQUISITOS = 'sin_requisitos';
	const BAJA_TEMPORAL = 'baja_temporal';
	const BAJA_PERMANENTE = 'baja_permanente';
	const SUSPENCION = 'suspencion';
	const DESTITUCION = 'destitucion';

    public function scopePermitedRoles($query){
        $role = self::SUPER_ADMIN;
        if ( !is_null(Auth::user()) && Auth::user()->hasRole($role) )
             return $query;
        else
            return $query->where('name','!=',Role::SUPER_ADMIN);
    }
}
