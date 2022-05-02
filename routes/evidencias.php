<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Evidencia;

Route::middleware(['role:instructor|director|admin|super_admin'])->group(function () {

	Route::get('descargar/{id}/{tipo}','EvidenciaController@download');

	Route::get('evidencia/{curso}/nuevo', 'EvidenciaController@evidencia')
		->name('evidencia.nuevo');

	Route::post('evidencia/{curso}', 'EvidenciaController@store')
		->name('evidencia.store');

	Route::get('evidencia/{curso}/delete', 'EvidenciaController@destroy')
		->name('evidencia.delete');
	
});
