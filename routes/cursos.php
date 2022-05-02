<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\SalonClaseAlumno;




Route::middleware(['roles'=>'role:instructor|director|admin|super_admin'])->group(function () {

	Route::get('certificacion/{curso}', 'CursoController@certificacion')
	->name('certificacion');
	Route::match(['get', 'post'],'diploma/{curso}', 'CursoController@diploma')
	->name('diploma');
	Route::match(['get', 'post'],'kardex/{curso}', 'CursoController@kardex')
	->name('kardex');
	Route::resource('cursos','CursoController');

	Route::get('cursos/{curso}/delete', 'CursoController@destroy')
	->name('cursos.delete');
	
	

	Route::match(['get', 'post'],'cursos.list', function(Request $request) {
		
		$items = Curso::query()->with('planes')->select('cursos.*');

		return DataTables::eloquent($items)
					->addColumn('fecha_inicio_str', function($item){ 
						return $item->fecha_inicio->format('d-m-Y') ?? '';
					})

					->addColumn('fecha_termino_str', function($item){ 
						return $item->fecha_termino->format('d-m-Y') ?? '';
					})

					->addColumn('oficio_fecha_str', function($item){ 
						return $item->oficio_fecha->format('d-m-Y') ?? '';
					})

					->addColumn('kardex_fecha_str', function($item){ 
						return $item->kardex_fecha->format('d-m-Y') ?? '';
					})
				
			        ->addColumn('acciones', function($item){ 
						$btn_editar = route('cursos.edit',$item->id);
						$btn_maestro = route('asignacion',$item->id);
						$btn_alumno = route('alumnos_asignacion',$item->id);
						$btn_kardex = route('certificacion',$item->id);
						$btn_evidencia = route('evidencia.nuevo',$item->id);
						$btn_cerrar_configuracion = route('cerrar_configuracion',$item->id);
						$btn_calificacion = route('calificaciones',$item->id);
						$btn_curso = route('cerrar_curso',$item->id);
						$action_buttons = "
							<div class='row d-flex justify-content-around'>
								<a href='$btn_maestro' class='px-1' title='Maestros'>
									<span class='badge badge-success text-white p-1 shadow'>
										<i class='fa fa-graduation-cap  fa-2x'></i>
									</span>
								</a>
								<a href='$btn_alumno' class='px-1' title='Alumnos'>
									<span class='badge badge-primary text-white p-1 shadow'>
										<i class='fa fa-user fa-2x'></i>
									</span>
								</a>
								<a href='$btn_evidencia' class='px-1' title='Evidencia'>
									<span class='badge badge-secondary text-white p-1 shadow'>
										<i class='fa fa-picture-o fa-2x'></i>
									</span>
								</a>
						";
							
							
							// if($x = CursoAlumno::where([  ['curso_id', $item->id],
							// ['status',1],])->first())
							// dd($x);{
					
							if($item->alumnos()->exists()){

								if($item->alumnos->first()->status == 1){
							//$salonAlumno =	DB::table('salon_clase_alumnos')->pluck('verificacion','id');
//dd($item->status_id );
//dd($item->alumnos()->aulas);


							if($item->status_id == 0)	{
									$action_buttons .= "
									<a href='$btn_cerrar_configuracion' class='px-1' title='Cerrar configuracion'>
										<span class='badge badge-dark text-white p-1 shadow'>
											<i class='fa fa-check-square fa-2x'></i>
										</span>
									</a>
									
									";



								}

								if( $item->status_curso == 1 )	{
									$action_buttons .=	" 
									<a href='$btn_calificacion' class='px-1' title='Calificaciones'>
									<span class='badge badge-light text-white p-1 shadow'>
										<i class='fa fa-file-text-o fa-2x'></i>
									</span>
								</a>
								<a href='$btn_kardex' class='px-1' title='Kardex' target='_blank'>
									<span class='badge badge-warning text-white p-1 shadow'>
										<i class='fa fa-certificate fa-2x'></i>
									</span>
								</a>
								<h6>
									<span class='badge badge-danger badge-pill'> Curso cerrrado</span>
									</h6>
									
									";
									
								}
									else{

										if($item->status_id == 1)	{
											$action_buttons .= "
											<a href='$btn_calificacion' class='px-1' title='Calificaciones'>
												<span class='badge badge-light text-white p-1 shadow'>
													<i class='fa fa-file-text-o fa-2x'></i>
												</span>
											</a>
											
											<a href='$btn_curso' class='px-1' title='Cerrar'>
											<span class='badge badge-danger text-white p-1 shadow'>
											<i class='fa fa-check fa-2x'></i> 
											</span>
										</a>
											
											
											";
										
											
										
										}
									}
							
								



						}
							
								}
						
							

								if($item->status_curso == 0)	{
									$action_buttons .="
									<a href='$btn_editar' class='px-1' title='Editar'>
										<span class='badge badge-warning text-white p-1 shadow'>
											<i class='fa fa-pencil fa-2x'></i>
										</span>
									</a>
									<h6 class='p-3'>
									<span class='badge badge-success badge-pill'> Curso Abierto</span>
									</h6>
									";
								}
		
								"
						</div>	
						";
						
			            return $action_buttons;
			        })
			        ->make(TRUE);
	})->name('cursos.list');

	Route::get('cerrar_configuracion/{curso}','CursoController@cerrar_configuracion')
		->name('cerrar_configuracion');
	Route::get('cerrar_alumnos/{curso}','CursoAlumnoController@cerrar_carga_alumnos')
		->name('cerrar_carga_alumnos');
	
	Route::get('cerrar_maestros/{curso}','CursoController@cerrar_carga_maestros')
		->name('cerrar_carga_maestros');
	Route::get('cerrar_curso/{curso}','CursoController@cerrar_curso')
		->name('cerrar_curso');

	//calificaciones
	Route::get('calificacion/{curso}','SalonClaseAlumnoController@calificaciones')
		->name('calificaciones');
	Route::get('calificaciones_bloquear/{salon_clase}', 'SalonClaseAlumnoController@bloquear')
		->name('bloquear');
	Route::post('calificaciones/{curso}', 'SalonClaseAlumnoController@store')
		->name('calificaciones.store');

	Route::match(['get', 'post'],'calificacion_materia/{curso}','SalonClaseAlumnoController@materias')
		->name('materias');
	
});
