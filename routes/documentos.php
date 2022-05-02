<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Documento;


Route::middleware(['roles'=>'role:user|reclutamiento|director|admin|super_admin'])->group(function () {
	
	Route::get('documentos/{persona}','DocumentoController@documentos')
		->name('documentos');

	Route::post('documentos/{persona}', 'DocumentoController@store')
		->name('documentos.store');

	Route::get('media/{id}/{tipo}','DocumentoController@download');

});

Route::middleware(['auth','user'])->group(function (){
	Route::get('documentos/{persona}','DocumentoController@documentos')
		->name('documentos');

	Route::post('documentos/{persona}', 'DocumentoController@store')
		->name('documentos.store');

	Route::get('media/{id}/{tipo}','DocumentoController@download');
});

