<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Referencia;
use App\Models\Persona;
use App\Models\Domicilio;
use App\Models\Escolaridad;
use App\Models\Nombramiento;
use App\User;
use App\Models\ContactoReferencia;
use App\Http\Controllers\ProfileController;

Route::group(['roles' => 'role:user'],function () {

	Route::get('/profile','ProfileController@index')->name('profile');
	Route::get('/profile/create','ProfileController@create')->name('profile.create');
	Route::get('/profile/{persona}/edit','ProfileController@edit')->name('profile.edit');
	Route::post('/profile/store','ProfileController@store')->name('profile.store');
	Route::patch('/profile/{persona}','ProfileController@update')->name('profile.update');

	Route::get('/profile.domicilio', function(Request $request) {
		$persona = Auth::user()->persona;
		if (is_null($persona)) return back();
		if (is_null($persona->domicilio)){
			$persona->domicilio = new Domicilio;
		}
		return view('profile.domicilio', compact('persona'));
	})->name('profile.domicilio');

	Route::get('/profile.escolaridad',function(Request $request){
		$persona = Auth::user()->persona; 
		if (is_null($persona)) return back();
		$page = "escolaridad";
		$route = route('estudios.store',$persona->id);
		return view('profile.escolaridad',compact('route','persona','page'));
	})->name('profile.escolaridad');

	Route::match(['get','post'],'/list.profile.escolaridad/{user}',
		function(Request $request, User $user){
			$items =  Escolaridad::where('persona_id',$user->persona_id)
						->with('nivel_escolar','estatus')
						->select('escolaridads.*');

			return DataTables::eloquent($items)
			        ->addColumn('acciones', function($item){ 
			        	$item_id = $item->id;
						$btn_delete = route('estudios.delete',$item->id);
						$action_buttons = "
							<div class='row d-flex justify-content-center'>
								<a href='$btn_delete' class='px-1 delete-button' title='Eliminar' id='item_$item_id'>
									<span class='badge badge-danger text-white shadow'>
										<i class='fa fa-trash fa-2x'></i>
									</span>
								</a>
							</div>	
						";
		                return $action_buttons;
		            })
		            ->make(TRUE);
	})->name('list.profile.escolaridad');

	Route::get('/profile.media_filiacion', function(Request $request){
		$persona = Auth::user()->persona;
		if (is_null($persona)) return back();
		return view('profile.filiacion',compact('persona'));

	})->name('profile.media_filiacion');

	Route::get('/profile.documentos', function(Request $request){
		$persona = Auth::user()->persona;
		if(is_null($persona)) return back();
		return view('profile.documentos',compact('persona'));
	})->name('profile.documentos');

	Route::get('/profile.nombramiento',function(Request $request){
		$persona = Auth::user()->persona; 
		if (is_null($persona)) return back();
		$page = "nombramiento";
		$route = route('nombramientos.store',$persona->id);
		return view('profile.nombramiento',compact('route','persona','page'));
	})->name('profile.nombramiento');


	Route::match(['get','post'],'/list.profile.nombramiento/{user}',
		function(Request $request, User $user){
			$items =  Nombramiento::where('persona_id',$user->persona_id)
						->select('nombramientos.*');

			return DataTables::eloquent($items)
			        ->addColumn('acciones', function($item){ 
			        	$item_id = $item->id;
						$btn_delete = route('nombramientos.delete',$item->id);
						$action_buttons = "
							<div class='row d-flex justify-content-center'>
								<a href='$btn_delete' class='px-1 delete-button' title='Eliminar' id='item_$item_id'>
									<span class='badge badge-danger text-white shadow'>
										<i class='fa fa-trash fa-2x'></i>
									</span>
								</a>
							</div>	
						";
		                return $action_buttons;
		            })
		            ->make(TRUE);
	})->name('list.profile.nombramiento');

	Route::get('/profile.referencias',function(Request $request){
		$persona = Auth::user()->persona; 
		if (is_null($persona)) return back();
		$page = "referencias";
		$route = route('referencias.store',$persona->id);
		return view('profile.referencias',compact('route','persona','page'));
	})->name('profile.referencias');

	Route::match(['get','post'],'/list.profile.referencias/{user}',
		function(Request $request, User $user){
			$items =  Referencia::where('persona_id',$user->persona_id)
						->with(['sexo','parentesco'])
						->select('referencias.*');

			return DataTables::eloquent($items)
			        ->addColumn('acciones', function($item){ 
			        	$item_id = $item->id;
						$btn_contacto = route('profile.referencias_contacto',$item->id);
						$btn_domicilio =route('profile.referencias_domcilio',$item->id);
						$btn_delete = route('referencias.delete',$item->id);
						$action_buttons = "
							<div class='row d-flex justify-content-center'>
								<a href='$btn_contacto' class='px-1' title='Contacto'>
									<span class='badge blue text-white shadow'>
										<i id='contacto' class='fa fa-phone fa-2x'></i>
									</span>
								</a>

								<a href='$btn_domicilio' class='px-1' title='Domicilio'>
									<span class='badge default-color text-white shadow'>
										<i class='fa fa-home fa-2x'></i>
									</span>
								</a>

								<a href='$btn_delete' class='px-1 delete-button' title='Eliminar' id='item_$item_id'>
									<span class='badge badge-danger text-white shadow'>
										<i class='fa fa-trash fa-2x'></i>
									</span>
								</a>
							</div>	
						";
		                return $action_buttons;
		            })
		            ->make(TRUE);
	})->name('list.profile.referencias');

	Route::match(['get','post'],'/profile.referencias_contacto/{referencia}', function(Request $request, Referencia $referencia){
		$route=route('contacto_referencias.store',$referencia->id);
		$persona = Auth::user()->persona; 
		return view('profile.contacto_referencias',compact('referencia','route','persona'));
	})->name('profile.referencias_contacto');

	Route::match(['get','post'],'/profile.referencias_domicilio/{referencia}', function(Request $request, Referencia $referencia){
		$route=route('domicilio_referencias.store',$referencia->id);
		$persona = Auth::user()->persona; 
		return view('profile.domicilio_referencias',compact('referencia','route','persona'));
	})->name('profile.referencias_domcilio');
});



