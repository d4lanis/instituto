<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Control;
use Carbon\Carbon;

Route::middleware(['roles'=>'role:reclutamiento|director|admin|super_admin'])->group(function () {
	
	Route::get('control/{persona}/nuevo','ControlController@nuevo_control')->name('nuevo_control');
	Route::get('control/{persona}','ControlController@control')->name('control');
	Route::get('control/{control}/edit','ControlController@edit')->name('editar_control');
	

	Route::resource('control','ControlController')->parameters(['control'=> 'control']);

	Route::get('control/{control}/delete', 'ControlController@destroy')
		->name('control.delete');
	
	Route::match(['get', 'post'],'control.list/{persona}', 
		function(Request $request, $persona) {
		$items = Control::query()
						->where('persona_id',$persona)
						->with(['motivo_control','resultado','tipo_control'])
						->select('controls.*');

		return DataTables::eloquent($items)

		->addColumn('fecha_resultado_str', function($item){ 
			return $item->fecha_resultado->format('d-m-Y') ?? '';
		})

		->addColumn('vigencia_str', function($item){ 
			return $item->vigencia->format('d-m-Y') ?? '';
		})

		->addColumn('status', function($item){ 
			// $inicio=$item->vigencia->format('d-m-Y');
			// $hoy=Carbon::now()->format('d-m-Y');
		$inicio=$item->vigencia;
		$hoy=Carbon::now();
		$diff = $hoy->diffInDays($inicio,false );
	

		$x = "	<div class='row d-flex '>";
	
if($diff >= 60) {

	$x .= "
	<h6>
	<span class='badge badge-success badge-pill'> Vigencia valida</span>
	</h6>";

	
	} else if(  $diff >= 0 &&  $diff < 60) {
	
		$x .= "
		<h6>
	<span class='badge badge-warning badge-pill'> Vigencia por vencer</span>
	</h6>
		
		
		";
	
	} else {
	
		$x .= "
		<h6>
	<span class='badge badge-danger badge-pill'> Vigencia vencida</span>
	</h6>
		
		
		";
	
	}

	return $x;
	 }) 	
		

		
					->addColumn('acciones', function($item){ 
						$btn_editar = route('control.edit',$item->id);
					
						$btn_eliminar = route('control.delete',$item->id);
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
	})->name('control.list');
});
