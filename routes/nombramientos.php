<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Nombramiento;


Route::middleware(['roles'=>'role:user|reclutamiento|director|admin|super_admin'])->group(function () {

	Route::get('nombramiento/{id}/{tipo}','NombramientoController@download');
	Route::get('nombramientos/{persona}/nuevo','NombramientoController@create')->name('nombramientos.create');

	Route::get('nombramientos/{persona}','NombramientoController@nombramientos')->name('nombramientos');
	Route::get('nombramientos/{nombramiento}/edit','NombramientoController@edit')->name('nombramientos.edit');
	Route::post('nombramientos_guardar/{persona}', 'NombramientoController@store')
		->name('nombramientos.store');
	
	Route::get('nombramientos/{nombramiento}/delete', 'NombramientoController@destroy')
		->name('nombramientos.delete');
	
	Route::match(['get', 'post'],'nombramientos.list/{persona}', 
		function(Request $request, $persona) {
		$items = Nombramiento::query()
							->where('persona_id',$persona)
							// ->with(['estatus','nivel_escolar'])
							->select('nombramientos.*');

		return DataTables::eloquent($items)



		->addColumn('fecha_inicio_str', function($item){ 
			return $item->fecha_inicio->format('d-m-Y') ?? '';	})

		
					->addColumn('acciones', function($item){ 
						$btn_editar = route('nombramientos.edit',$item->id);
					
						$btn_eliminar = route('nombramientos.delete',$item->id);
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
	})->name('nombramientos.list');

});

/*Route::middleware(['auth','user' ])->group(function (){
	Route::post('nombramientos_guardar/{persona}', 'NombramientoController@store')
		->name('nombramientos.store');

	Route::get('nombramientos/{nombramiento}/delete', 'NombramientoController@destroy')
		->name('nombramientos.delete');
});*/