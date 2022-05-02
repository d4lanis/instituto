<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Evento_evidencia;

Route::middleware(['roles'=>'role:reclutamiento|director|admin|super_admin'])->group(function () {

	// Route::middleware(['instructor' ])->group(function () {

	Route::get('descargar/{id}/{tipo}','EventoEvidenciaController@download');

	Route::get('evento_evidencia/{evento}/nuevo', 'EventoEvidenciaController@evento_evidencia')
		->name('evento_evidencia.nuevo');

	Route::post('evento_evidencia/{evento}', 'EventoEvidenciaController@store')
	->name('evento_evidencia.store');

	Route::get('evento_evidencia/{evento}/delete', 'EventoEvidenciaController@destroy')
		->name('evento_evidencia.delete');
	
		
});
// });
