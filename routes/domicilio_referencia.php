<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Referencia;
use App\Models\DomicilioReferancia;

Route::middleware(['auth','roles'=>'role:user|reclutamiento|director|admin|super_admin'])->group(function () {
	
	Route::get('domicilio_referencia/{referencia}','DomicilioReferenciaController@domicilioinfo')->name('domicilioinfo');

	Route::post('domicilio_referencias/{referencia}', 'DomicilioReferenciaController@store')
		->name('domicilio_referencias.store');

});

/*Route::middleware(['auth','user'])->group(function (){

	Route::post('domicilio_referencias/{referencia}', 'DomicilioReferenciaController@store')
		->name('domicilio_referencias.store');
		
});*/



