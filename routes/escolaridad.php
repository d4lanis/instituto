<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Escolaridad;


Route::middleware(['roles'=>'role:user|reclutamiento|director|admin|super_admin'])->group(function () {
	
	Route::get('estudios/{persona}/nuevo','EscolaridadController@nuevo_estudio')
		->name('estudios.create');

	Route::get('estudios/{persona}','EscolaridadController@estudios')
		->name('estudios');
	Route::get('estudios/{escolaridad}/edit','EscolaridadController@edit')
		->name('estudios.edit');
	Route::post('estudios_guardar/{persona}', 'EscolaridadController@store')
		->name('estudios.store');
	

	Route::get('estudios/{escolaridad}/delete', 'EscolaridadController@destroy')
		->name('estudios.delete');
	
	Route::match(['get', 'post'],'estudios.list/{persona}', 
		function(Request $request, $persona) {
			$items = Escolaridad::query()
							->where('persona_id',$persona)
							->with(['estatus','nivel_escolar'])
							->select('escolaridads.*');

			return DataTables::eloquent($items)
						->addColumn('acciones', function($item){ 
							$btn_editar = route('estudios.edit',$item->id);
						
							$btn_eliminar = route('estudios.delete',$item->id);
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
	})->name('estudios.list');

});

Route::middleware(['auth','user'])->group(function (){
	Route::get('estudios/{escolaridad}/delete', 'EscolaridadController@destroy')
		->name('estudios.delete');
	Route::post('estudios_guardar/{persona}', 'EscolaridadController@store')
		->name('estudios.store');
});