<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Maestro;


Route::middleware(['roles'=>'role:instructor|director|admin|super_admin'])->group(function () {

	Route::resource('maestros','MaestroController');

	Route::get('maestros/{maestro}/delete', 'MaestroController@destroy')
		->name('maestros.delete');
	
	Route::match(['get', 'post'],'maestros.list', function(Request $request) {
		$items = Maestro::query()
		->select('maestros.*');

		return DataTables::eloquent($items)
				
			        ->addColumn('acciones', function($item){ 
						$btn_editar = route('maestros.edit',$item->id);
						
						$btn_eliminar = route('maestros.delete',$item->id);

						$action_buttons = "
						<div class='row d-flex justify-content-around'>
							<a href='$btn_editar' class='px-1' title='Editar'>
								<span class='badge badge-warning text-white p-1 shadow'>
									<i class='fa fa-pencil fa-2x'></i>
								</span>
							</a>
						
							<a href='$btn_eliminar' class='px-1' title='Eliminar'>
								<span class='badge badge-danger text-white p-1 shadow'>
								<i class='fa fa-trash fa-2x'></i>
								</span>
							</a>
						
						</div>	
						";
						
			            return $action_buttons;
			        })
			        ->make(TRUE);
	})->name('maestros.list');

});
