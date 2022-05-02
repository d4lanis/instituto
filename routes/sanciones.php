<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Sancion;

Route::middleware(['roles'=>'role:reclutamiento|director|admin|super_admin'])->group(function () {

	Route::get('sancion/{id}/{tipo}','SancionController@download');
	Route::get('sanciones/{persona}/nuevo','SancionController@nueva_sancion')
		->name('sanciones.create');
	Route::get('sanciones/{persona}','SancionController@sanciones')
		->name('sanciones');
	Route::get('sanciones/{sancion}/edit','SancionController@edit')
		->name('sanciones.edit');
	
	Route::post('sanciones_guardar/{persona}', 'SancionController@store')
		->name('sanciones.store');
	

	Route::get('sanciones/{sancion}/delete', 'SancionController@destroy')
		->name('sanciones.delete');
	
	Route::match(['get', 'post'],'sanciones.list/{persona}', 
		function(Request $request, $persona) {

		$items = Sancion::query()
						->where('persona_id',$persona)
						->with(['tipo_sancion','estado_sancion'])
						->select('sancions.*');

		return DataTables::eloquent($items)
					->addColumn('fecha_inicio_str', function($item){ 
						return $item->fecha_inicio->format('d-m-Y') ?? '';
					})
					->addColumn('fecha_termino_str', function($item){ 
						return $item->fecha_termino->format('d-m-Y') ?? '';
					})
					->addColumn('acciones', function($item){ 
						$btn_editar = route('sanciones.edit',$item->id);
					
						$btn_eliminar = route('sanciones.delete',$item->id);
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
			        
	})->name('sanciones.list');

});