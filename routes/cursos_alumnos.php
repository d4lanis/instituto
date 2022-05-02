<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Persona;
use App\Models\CursoAlumno;

Route::middleware(['roles'=>'role:instructor|director|admin|super_admin'])->group(function () {

		Route::get('asignacion_alumnos/{curso}','CursoAlumnoController@alumnos_asignacion')->name('alumnos_asignacion');

		Route::post('asignacion_alumnos/{curso}', 'CursoAlumnoController@store')
			->name('asignacion_alumnos.store');
	
		Route::match(['get', 'post'],'/cursos.alumnos.asignados/{curso}', function(Curso $curso) {

			$alumnos_asignados = CursoAlumno::where('curso_id',$curso->id)		
					->select('curso_alumnos.persona_id as id', 'personas.categoria_puestos_id as categoria_puestos_id','personas.nombre as name')
            		->join('personas', 'curso_alumnos.persona_id', '=', 'personas.id')
		            ->get()->map( function ($item){
						return collect($item)->only(['name','id','categoria_puestos_id'])->all();
					});

			return response()->json([
						'status' => 'ok',
						'data' => $alumnos_asignados
					]);
		})->name('cursos.alumnos.asignados');
	
		Route::match(['get', 'post'],'/cursos.alumnos.disponibles/{curso}', 
			function(Curso $curso) {
	
				$alumnos_asignados = $curso->alumnos ?? collect();
					
				$disponibles = Persona::whereNotIn('id', $alumnos_asignados->pluck('persona_id'))
					->select('id','nombre as name', 'categoria_puestos_id')->get()
					->map( function ($item){
						return collect($item)->only(['name','id','categoria_puestos_id'])->all();
					});
			
			    return response()->json([
			        'status' => 'ok',
			        'data' => $disponibles
		    	]);

	})->name('cursos.alumnos.disponibles');

});
