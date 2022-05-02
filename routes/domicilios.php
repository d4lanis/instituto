<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Domicilio;

Route::middleware(['role:user|reclutamiento|director|admin|super_admin'])->group(function () {
	
	Route::get('domicilio/{persona}','DomicilioController@domicilio')
		->name('domicilio');
	Route::post('domicilio/{persona}', 'DomicilioController@store')
		->name('domicilio');

});

/*Route::middleware(['auth','user' ])->group(function () {
	
	Route::post('domicilio/{persona}', 'DomicilioController@store')
		->name('domicilio');

});*/



