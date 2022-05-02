<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Merito;




Route::middleware(['roles'=>'role:reclutamiento|director|admin|super_admin'])->group(function () {

	Route::get('merito/{id}/{tipo}','MeritoController@download');
	Route::get('meritos/{persona}/nuevo','MeritoController@nuevo_merito')->name('meritos.create');

	Route::get('meritos/{persona}','MeritoController@meritos')->name('meritos');
	Route::get('meritos/{merito}/edit','MeritoController@edit')->name('meritos.edit');
	Route::post('meritos_guardar/{persona}', 'MeritoController@store')
		->name('meritos.store');
	
	Route::get('meritos/{merito}/delete', 'MeritoController@destroy')
		->name('meritos.delete');
	
	Route::match(['get', 'post'],'meritos.list/{persona}', 
		function(Request $request, $persona) {
			$items = Merito::query()
			->where('persona_id',$persona)
			->with(['tipo_merito','merito_por'])
			->select('meritos.*');

		return DataTables::eloquent($items)

		->addColumn('fecha_reconocimiento_str', function($item){ 
			return $item->fecha_reconocimiento->format('d-m-Y') ?? '';
		})

		
					->addColumn('acciones', function($item){ 
						$btn_editar = route('meritos.edit',$item->id);
					
						$btn_eliminar = route('meritos.delete',$item->id);
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
	})->name('meritos.list');

});









