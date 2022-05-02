<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Referencia;
use App\Models\ContactoReferencia;

Route::middleware(['roles'=>'role:user|reclutamiento|director|admin|super_admin'])->group(function () {

	Route::get('contacto_referencia/{referencia}','ContactoReferenciaController@contactoinfo')
		->name('contactoinfo');
	Route::post('contacto_referencias/{referencia}', 'ContactoReferenciaController@store')
		->name('contacto_referencias.store');

});

Route::middleware(['auth','user'])->group(function () {
	Route::post('contacto_referencias/{referencia}', 'ContactoReferenciaController@store')
		->name('contacto_referencias.store');
});