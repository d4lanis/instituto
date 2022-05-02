<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Cambio;

Route::middleware(['auth','roles'=>'role:reclutamiento|director|admin|super_admin'])->group(function () {

	Route::get('cambio/{id}/{tipo}','CambioController@download');
	Route::get('cambios/{persona}/nuevo','CambioController@nuevo_cambio')
		->name('cambios.create');

	Route::get('cambios/{persona}','CambioController@cambios')
		->name('cambios');
	Route::get('cambios/{cambio}/edit','CambioController@edit')
		->name('cambios.edit');
	Route::post('cambios_guardar/{persona}', 'CambioController@store')
		->name('cambios.store');

	Route::get('cambios/{cambio}/delete', 'CambioController@destroy')
		->name('cambios.delete');
	
	Route::match(['get', 'post'],'cambios.list/{persona}', 
		function(Request $request, $persona) {

			$items = Cambio::query()
							->where('persona_id',$persona)
							->with(['motivo_cambio','puesto','puesto_nuevo'])
							->select('cambios.*');

			return DataTables::eloquent($items)
					->addColumn('fecha_cambio_str', function($item){ 
						return $item->fecha_cambio->format('d-m-Y') ?? '';
					})
					->addColumn('nombre_completo', function($item){ 
						return $item->nombre_completo ?? '';
					})
					->addColumn('acciones', function($item){ 
						$btn_editar = route('cambios.edit',$item->id);
					
						$btn_eliminar = route('cambios.delete',$item->id);
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
			        
	})->name('cambios.list');

});
