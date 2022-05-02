<?php

use App\Models\Materia;
use Illuminate\Http\Request;

Route::middleware(['roles'=>'role:instructor|director|admin|super_admin'])->group(function () {
	// Materias
	Route::resource('materias', 'MateriaController')->except(['show']);
	Route::get('materias/{materia}/delete', 'MateriaController@destroy')
		->name('materias.delete');

	Route::match(['get', 'post'],'list.materias', 
		function(Request $request) {
			$items = Materia::query()->with(['tipo_materia','categoria_materia'])
						->select('materias.*');

			return DataTables::eloquent($items)
		        ->addColumn('acciones', function($item){ 
					$btn_edit = route('materias.edit',$item->id);
					$btn_delete = route('materias.delete',$item->id);
					$action_buttons = "
						<div class='row d-flex jsonustify-content-center'>
							<a href='$btn_edit' class='px-1' title='Editar'>
								<span class='badge orange text-white shadow'>
									<i class='fa fa-pencil fa-2x'></i>
								</span>
							</a>
							<a href='$btn_delete' class='px-1' title='Eliminar'>
								<span class='badge badge-danger text-white shadow'>
									<i class='fa fa-trash fa-2x'></i>
								</span>
							</a>
						</div>	
					";
					
	                return $action_buttons;
	            })
	            ->make(TRUE);
	})->name('list.materias');

});

