<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Baja;

Route::middleware(['roles'=>'role:reclutamiento|director|admin|super_admin'])->group(function () {

		Route::get('baja/{id}/{tipo}','BajaController@download');
		
		Route::get('bajas/{persona}/nuevo','BajaController@nuevo_baja')
			->name('bajas.create');

		Route::get('bajas/{persona}','BajaController@bajas')
			->name('bajas');
		Route::get('bajas/{baja}/edit','BajaController@edit')
			->name('bajas.edit');
		Route::post('bajas_guardar/{persona}', 'BajaController@store')
			->name('bajas.store');
		
		Route::get('bajas/{baja}/delete', 'BajaController@destroy')
			->name('bajas.delete');
		
		Route::match(['get', 'post'],'bajas.list/{persona}', 
			function(Request $request, $persona) {
			$items = Baja::query()
							->where('persona_id',$persona)
							->with(['tipo_baja','motivo_baja'])
							->select('bajas.*');

			return DataTables::eloquent($items)
						->addColumn('fecha_baja_str', function($item){ 
							return $item->fecha_baja->format('d-m-Y') ?? '';
						})
						->addColumn('acciones', function($item){ 
							$btn_editar = route('bajas.edit',$item->id);
						
							$btn_eliminar = route('bajas.delete',$item->id);
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
				        
		})->name('bajas.list');

});
