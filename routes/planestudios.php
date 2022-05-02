<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\PlanEstudio;


Route::middleware(['roles'=>'role:instructor|director|admin|super_admin'])->group(function () {

	Route::resource('planEstudios','PlanEstudioController');

	Route::get('planEstudios/{planEstudio}/delete', 'PlanEstudioController@destroy')
		->name('planEstudios.delete');

	Route::match(['get', 'post'],'planEstudios.list', function(Request $request) {
		$items = PlanEstudio::query()
		->select('planestudios.*');

		return DataTables::eloquent($items)
				
			        ->addColumn('acciones', function($item){ 
						$btn_editar = route('planEstudios.edit',$item->id);
						$btn_asignar = route('lista',$item->id);
						$btn_eliminar = route('planEstudios.delete',$item->id);

						$action_buttons = "
						<div class='row d-flex justify-content-around'>
							<a href='$btn_editar' class='px-1' title='Editar'>
								<span class='badge badge-warning text-white p-1 shadow'>
									<i class='fa fa-pencil fa-2x'></i>
								</span>
							</a>
							<a href='$btn_asignar' class='px-1' title='Asignar'>
								<span class='badge badge-success text-white p-1 shadow'>
									<i class='fa fa-list-ul fa-2x'></i>
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
	})->name('planEstudios.list');

	Route::match(['get', 'post'],'planesdeestudio','CursoController@planestudio')->name('planestudio');

});
