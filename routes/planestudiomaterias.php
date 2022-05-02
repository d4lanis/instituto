<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\PlanEstudioMateria;
use App\Models\PlanEstudio;
use App\Models\Materia;

Route::middleware(['role:instructor|director|admin|super_admin'])->group(function () {

	Route::get('planestudiomaterias/{planEstudio}','PlanEstudioMateriaController@lista')
		->name('lista');

	Route::post('planestudiomaterias/{planEstudio}','PlanEstudioMateriaController@store')
		->name('planestudiomaterias.store');

	Route::match(['get', 'post'],'/planestudio.materias.asignadas/{planEstudio}', 
		function(PlanEstudio $planEstudio) {

		$rows = PlanEstudioMateria::where('plan_estudio_id',$planEstudio->id)			
					->with('materia')
					->get()
					->pluck('materia.nombre','materia_id')
					->toArray();

		$materias_asignadas = [];		
		foreach($rows as $id => $name){
			$materias_asignadas[] = [
				"id" => $id,
				"name" => $name
			];
		} ;

	    return response()->json([
	        'status' => 'ok',
	        'data' => $materias_asignadas
	    ]);
	})->name('planestudio.materias.asignadas');

	Route::match(['get', 'post'],'/planestudio.materias.disponibles/{planEstudio}', 
		function(PlanEstudio $planEstudio) {

		$materias_asignadas = $planEstudio->materias ?? collect();

		
		$materias_disponibles=
				Materia::whereNotIn('id', 
					$materias_asignadas->pluck('materia_id')->toArray()
				)->select('id','nombre as name')->get();

	    return response()->json([
	        'status' => 'ok',
	        'data' => $materias_disponibles
	    ]);
	})->name('planestudio.materias.disponibles');

});
