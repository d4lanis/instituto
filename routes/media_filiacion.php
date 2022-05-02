<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Filiacion;

Route::middleware(['roles'=>'role:user|reclutamiento|director|admin|super_admin'])->group(function () {
	
	Route::get('media_filiacion/{persona}','FiliacionController@mediafiliacion')->name('mediafiliacion');
	Route::post('media_filiacion/{persona}', 'FiliacionController@store')
		->name('media_filiacion.store');

});

/*Route::middleware(['auth','user'])->group(function (){
	Route::post('media_filiacion/{persona}', 'FiliacionController@store')
		->name('media_filiacion.store');
});*/

