<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Evento;


Route::middleware(['roles'=>'role:reclutamiento|director|admin|super_admin'])->group(function () {

	Route::get('evento/{id}/{tipo}','EventoController@download');
	Route::resource('eventos','EventoController');

	Route::get('eventos/{evento}/delete', 'EventoController@destroy')
		->name('eventos.delete');
	
	Route::match(['get', 'post'],'eventos.list', 
		function(Request $request) {
			$items = Evento::query()
			->select('eventos.*');

			
			

		return DataTables::eloquent($items)

		->addColumn('fecha_evento_str', function($item){ 
			return $item->fecha_evento->format('d-m-Y') ?? '';
		})
		->addColumn('acciones', function($item){ 
		

			$btn_editar = route('eventos.edit',$item->id);
			$btn_evidencia = route('evento_evidencia.nuevo',$item->id);
			$btn_eliminar = route('eventos.delete',$item->id);

			$action_buttons = "
			<div class='row d-flex justify-content-around'>";

		

			$action_buttons .= "
				<a href='$btn_editar' class='px-1' title='Editar'>
						<span class='badge badge-warning text-white p-1 shadow'>
							<i class='fa fa-pencil fa-2x'></i>
						</span>
				</a>

				<a href='$btn_evidencia' class='px-1' title='Evidencia'>
						<span class='badge badge-secondary text-white p-1 shadow'>
							<i class='fa fa-picture-o fa-2x'></i>
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
	})->name('eventos.list');
    
});