<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Reporte;


Route::middleware(['roles'=>'role:admin|super_admin|director|reclutamiento|director'])->group(function () {

		Route::get('general', 'ReporteController@general')
			->name('general');
		Route::get('aprobados', 'ReporteController@aprobados')
			->name('aprobados');
		Route::resource('reportes', 'ReporteController');

});
