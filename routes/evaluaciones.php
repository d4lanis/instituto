<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Evaluacion;

Route::middleware(['roles'=>'role:reclutamiento|director|admin|super_admin'])->group(function () {
	Route::get('evaluaciones/{persona}/nuevo','EvaluacionController@nueva_evaluacion')->name('nueva_evaluacion');
	Route::get('evaluaciones/{persona}','EvaluacionController@evaluaciones')->name('evaluaciones');
	Route::get('evaluaciones/{evaluacion}/edit','EvaluacionController@edit')->name('editar_evaluacion');

	Route::resource('evaluaciones','EvaluacionController')->parameters(['evaluaciones'=> 'evaluacion']);

	Route::get('evaluaciones/{evaluacion}/delete', 'EvaluacionController@destroy')
		->name('evaluaciones.delete');
	
	Route::match(['get', 'post'],'evaluaciones.list/{persona}', 
		function(Request $request, $persona) {
		$items = Evaluacion::query()
						->where('persona_id',$persona)
						->with(['tipo_evaluacion','resultado'])
						->select('evaluacions.*');

		return DataTables::eloquent($items)

		->addColumn('fecha_resultado_str', function($item){ 
			return $item->fecha_resultado->format('d-m-Y') ?? '';
		})

		
					->addColumn('acciones', function($item){ 
						$btn_editar = route('evaluaciones.edit',$item->id);
					
						$btn_eliminar = route('evaluaciones.delete',$item->id);
						$action_buttons = "
							<div class='row d-flex justify-content-around'>
							

								<a href='$btn_editar' class='px-1' title='Editar'>
								<span class='badge blue text-white shadow'>
								<i class='fa fa-pencil fa-2x'></i>
								</span>
							</a>
								<a href='$btn_eliminar' class='px-1 ' title='Eliminar'
									>
									<span class='badge badge-danger text-white p-1 shadow'>
									<i class='fa fa-trash fa-2x'></i>
									</span>
								</a>
							
							</div>	
							";
						
			            return $action_buttons;
			        })
			        ->make(TRUE);
	})->name('evaluaciones.list');

});
