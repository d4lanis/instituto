<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Referencia;

Route::middleware(['roles'=>'role:user|reclutamiento|director|admin|super_admin'])->group(function () {

	Route::get('referencias/{persona}/nuevo','ReferenciaController@create')
		->name('referencias.create');
	Route::get('referencias/{persona}','ReferenciaController@referencia')
		->name('referencia');
	Route::get('referencias/{referencia}/edit','ReferenciaController@edit')
		->name('referencias.edit');
	Route::post('referencias_guardar', 'ReferenciaController@store')
		->name('referencias.store');
	Route::get('referencias/{referencia}/delete', 'ReferenciaController@destroy')
		->name('referencias.delete');

	Route::match(['get', 'post'],'referencias.list/{persona}', 
		function(Request $request, $persona) {
	
		$items = Referencia::query()
						->where('persona_id',$persona)
						->with(['sexo','parentesco'])
						->select('referencias.*');

		return DataTables::eloquent($items)
					->addColumn('acciones', function($item) { 
						$item_id = $item->id;
						$btn_editar = route('referencias.edit',$item->id);
						$btn_eliminar = route('referencias.delete',$item->id);
						$btn_contacto = route('contactoinfo',$item->id);
						$btn_domicilio= route('domicilioinfo',$item->id);

						$action_buttons = "
							<div class='row d-flex justify-content-around'>
						
							<a href='$btn_editar' class='px-1' title='Editar'>
							<span class='badge yellow text-white shadow'>
							<i class='fa fa-pencil fa-2x'></i>
							</span>
						</a>
							
								<a href='$btn_contacto' class='px-1' title='Contacto'>
								<span class='badge blue text-white shadow'>
								<i class='fa fa-phone fa-2x'></i>
								</span>
							</a>
							<a href='$btn_domicilio' class='px-1' title='Domicilio'>
							<span class='badge default-color text-white shadow'>
								<i class='fa fa-home fa-2x'></i>
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
	})->name('referencias.list');

});
