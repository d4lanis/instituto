<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Asignacion;

Route::middleware(['roles'=>'role:instructor|director|admin|super_admin'])->group(function () {

	Route::get('asignacion/{curso}','AsignacionController@asignacion')
		->name('asignacion');
	Route::post('asignacions/{curso}', 'AsignacionController@store')
		->name('asignacions.store');

	Route::match(['get', 'post'],'maestroslist','AsignacionController@maestro')
		->name('maestros');

});
