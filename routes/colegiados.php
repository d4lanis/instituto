<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Colegiado;


Route::middleware(['roles'=>'role:reclutamiento|director|super_admin'])->group(function () {

	Route::get('colegiado/{id}/{tipo}','ColegiadoController@download');
	Route::resource('colegiados','ColegiadoController');

	Route::get('colegiados/{colegiado}/delete', 'ColegiadoController@destroy')
		->name('colegiados.delete');
	
	Route::match(['get', 'post'],'colegiados.list', 
		function(Request $request) {
			$items = Colegiado::query()
			->select('colegiados.*');

			
			

		return DataTables::eloquent($items)

		->addColumn('fecha_solicitud_str', function($item){ 
			return $item->fecha_solicitud->format('d-m-Y') ?? '';
		})
		->addColumn('acciones', function($item){ 
		

			$btn_editar = route('colegiados.edit',$item->id);
			
			$btn_eliminar = route('colegiados.delete',$item->id);

			$action_buttons = "
			<div class='row d-flex justify-content-around'>";

		

			$action_buttons .= "
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
	})->name('colegiados.list');
    
});