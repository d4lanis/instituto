<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Domicilio;


Route::middleware(['roles'=>'role:user|reclutamiento|director|admin|super_admin'])->group(function () { 

	Route::get('hojadevida/{persona}','PersonaController@hojadevida')->name('hojadevida');
	Route::resource('personas','PersonaController');
	Route::get('personas/{persona}/delete', 'PersonaController@destroy')
		->name('personas.delete');

	Route::match(['get', 'post'],'personas.list', function(Request $request) {
		$items = Persona::query()
					->with(['sexo','categoria_puestos','tipo_sanguineo','cargo_puesto'])
					->select('personas.*');

		return DataTables::eloquent($items)
					->addColumn('fecha_ingreso_str', function($item){ 
						//return $item->fecha_ingreso->format('d-m-Y') ?? '';
						return isset($item->fecha_ingreso) ? $item->fecha_ingreso->format('d-m-Y') : '';
					})
					->addColumn('fecha_nacimiento_str', function($item){ 
						//return $item->fecha_nacimiento->format('d-m-Y') ?? '';
						return isset($item->fecha_nacimiento) ? $item->fecha_nacimiento->format('d-m-Y') : '';
					})
			        ->addColumn('acciones', function($item){ 
						$btn_editar = route('personas.edit',$item->id);
						$btn_record = route('domicilio',$item->id);
						$btn_activos = route('evaluaciones',$item->id);
						
						$btn_vida = route('hojadevida',$item->id);
						$btn_eliminar = route('personas.delete',$item->id);

						$action_buttons = "
						<div class='row d-flex justify-content-around'>
							<a href='$btn_editar' class='px-1' title='Editar'>
								<span class='badge badge-warning text-white p-1 shadow'>
									<i class='fa fa-pencil fa-2x'></i>
								</span>
							</a>
							<a href='$btn_eliminar' class='px-1' title='Eliminar' style='display: none;'>
								<span class='badge badge-danger text-white p-1 shadow'>
								<i class='fa fa-trash fa-2x'></i>
								</span>
							</a>
							<a href='$btn_record' class='px-1' title='Expediente'>
								<span class='badge badge-info text-white p-1 shadow'>
									<i class='fa fa-gear fa-2x'></i>
								</span>
							</a>
							<a href='$btn_activos' class='px-1' title='Documentacion'>
							<span class='badge badge-dark text-white p-1 shadow'>
								<i class='fa fa-archive fa-2x'></i>
							</span>
						</a>
							<a href='$btn_vida' class='px-1' title='Hoja de vida'>
							<span class='badge badge-success text-white p-1 shadow'>
								<i class='fa fa-id-card-o fa-2x'></i>
							</span>
						</a>
						</div>	
						";
						
			            return $action_buttons;
			        })
			        ->make(TRUE);
	})->name('personas.list');

});


