@extends('layouts.master')

@section('content')
	<div class="container">
		<div class="col-md-12">			
			<form id="ingresos_form" method="POST" action="{{$route}}" class="ml-4">
				@csrf
		        {{ method_field($method) }}

				<div class="p-2 col-md-12 row teal white-text z-depth-1 rounded">

					<div>
						<h3 class="text-capitalize pt-1 pl-2">
							{{$method=='POST'?'nuevo':'modificar'}} Ingreso</h3>
					</div>

					<div class="ml-auto">
						<a href="{{route('personas.index')}}" class="p-2">
	                        <span class="badge badge-primary text-white p-2 z-depth-2">
	                            <i class="fa fa-undo fa-2x" aria-hidden="true"></i>
	                        </span>
	                    </a>

	                    <a href="#" class="px-2" 
	                        onclick="document.getElementById('ingresos_form').submit();">
	                        <span class="badge badge-warning text-white p-2 z-depth-2">
	                            <i class="fa fa-save fa-2x" aria-hidden="true"></i>
	                        </span>
	                    </a>
					</div>
				</div>

				<div class="col-md-12 my-4">
					<div class="form-row">
						<div class="form-group col-md-4">
							<label class="required" for="numero_convocatoria">
								* Num Convocatoria</label>
							<input type="text" class="form-control" id="numero_convocatoria"  
							name="numero_convocatoria"   
							value="{{old('numero_convocatoria',$registro->numero_convocatoria ?? '')}}">
						</div>
						<div class="form-group col-md-4">
							<label for="numero_empleado">Num Empleado</label>
							<input type="text" class="form-control" id="numero_empleado"  
							name="numero_empleado" 
							value="{{old('numero_empleado',$registro->numero_empleado ?? '')}}">
						</div>
						<div class="form-group col-md-4">
							<label class="required" for="fecha_ingreso">
								* Fecha de Ingreso</label>
							<input type="date" class="form-control" id="fecha_ingreso"  
							name="fecha_ingreso"   	
							value="{{old('fecha_ingreso',isset($registro->fecha_ingreso) ?
										$registro->fecha_ingreso->format('Y-m-d') : '')}}">
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-4">
							<label class="required" for="paterno">* Apellido Paterno</label>
							<input type="text" class="form-control" id="paterno"  
							name="paterno" value="{{old('paterno',$registro->paterno ?? '')}}">
						</div>
						<div class="form-group col-md-4">
							<label class="required" for="materno">* Apellido Materno</label>
							<input type="text" class="form-control" id="materno"  
							name="materno" value="{{old('materno',$registro->materno ?? '')}}">
						</div>
						<div class="form-group col-md-4">
							<label class="required" for="nombre">* Nombre</label>
							<input type="text" class="form-control" id="nombre"  
							name="nombre" value="{{old('nombre',$registro->nombre ?? '')}}">
						</div>
					</div>
						
					<div class="form-row">
						<div class="form-group col-md-4">
							<label for="adscripcion_id">Adscripcion</label>
							<select id="adscripcion_id" name="adscripcion_id" 
								class="col-md-12 browser-default custom-select">
							</select>
						</div>
						<div class="form-group col-md-4">
							<label class="required" for="categoria_puestos_id">Puesto *</label>
							<select id="categoria_puestos_id" name="categoria_puestos_id" 
								class="col-md-12 browser-default custom-select">
							</select>
						</div>
						<div class="form-group col-md-4">
							<label class="required" for="cargo_puesto_id">* Cargo</label>
							<select id="cargo_puesto_id" name="cargo_puesto_id" 
								class="col-md-12 browser-default custom-select">
							</select>
						</div>
					</div>
											
					<div class="form-row">
						<div class="form-group col-md-4">
							<label class="required" for="status_id">* Status</label>
							<select id="status_id" name="status_id" 
								class="col-md-12 browser-default custom-select">
							</select>
						</div>

						<div class="form-group col-md-4">
							<label class="required" for="fecha_nacimiento">
								* Fecha de nacimiento</label>
							<input type="date" class="form-control" id="fecha_nacimiento"  
							name="fecha_nacimiento"   	
							value="{{old('fecha_nacimiento', isset($registro->fecha_nacimiento) ?
									$registro->fecha_nacimiento->format('Y-m-d') : '')}}">
						</div>

						<div class="form-group col-md-4">
							<label for="lugar_nacimiento">Lugar de nacimiento </label>
							<input type="text" class="form-control" id="lugar_nacimiento"  
							name="lugar_nacimiento" 
							value="{{old('lugar_nacimiento',$registro->lugar_nacimiento ?? '')}}">
						</div>
					</div>
										
					<div class="form-row">
						<div class="form-group col-md-3">
							<label class="required" for="edad">* Edad</label>
							<input type="number" class="form-control" id="edad"  
							name="edad" value="{{old('edad',$registro->edad ?? 18)}}">
						</div>
						<div class="form-group col-md-3">
							<label class="required" for="sexo_id">* Sexo</label>
							<select id="sexo_id" name="sexo_id" 
							class="col-md-12 browser-default custom-select">
							</select>
						</div>
						<div class="form-group col-md-3">
							<label class="required" for="estado_civil_id">* Estado civil</label>
							<select id="estado_civil_id" name="estado_civil_id" 
								class="col-md-12 browser-default custom-select">
							</select>
						</div>
						<div class="form-group col-md-3">
							<label for="tipo_sanguineo_id">Tipo Sanguíneo</label>
							<select id="tipo_sanguineo_id" name="tipo_sanguineo_id" 
								class="col-md-12 browser-default custom-select">
							</select>
						</div>
					</div>
										
					<div class="form-row">
						<div class="form-group col-md-4">
							<label class="required" for="rfc">* RFC</label>
							<input type="text" class="form-control" id="rfc"  
							name="rfc" value="{{old('rfc',$registro->rfc ?? '')}}">
						</div>
						<div class="form-group col-md-4">
							<label class="required" for="curp">* CURP</label>
							<input type="text" class="form-control" id="curp"  
								name="curp" value="{{old('curp',$registro->curp ?? '')}}">
						</div>
						<div class="form-group col-md-4">
							<label for="cuip">CUIP</label>
							<input type="text" class="form-control" id="cuip"  
								name="cuip" value="{{old('cuip',$registro->cuip ?? '')}}">
						</div>
					</div>
                </div>
            </form>
		</div>
	</div>
	<br>
	<br>

@endsection


@push('scripts2')
	<script type="text/javascript">
		$(document).ready(function() {
            dynamicDropdown("/items/{{ App\Models\Catalogo::SEXO }}", 
            	{{ old('sexo_id', $registro->sexo_id ?? 0) }}, 'sexo_id');
            dynamicDropdown("/items/{{ App\Models\Catalogo::TIPO_SANGRE }}", 
            	{{ old('tipo_sanguineo_id', $registro->tipo_sanguineo_id ?? 0) }}, 
            	'tipo_sanguineo_id');
			dynamicDropdown("/items/{{ App\Models\Catalogo::CATEGORIA_PUESTOS }}", 
            	{{ old('categoria_puestos_id', $registro->categoria_puestos_id ?? 0) }}, 
            	'categoria_puestos_id');
			dynamicDropdown("/items/{{ $registro->categoria_puestos_id }}", 
				{{ old('cargo_puesto_id', $registro->cargo_puesto_id ?? 0) }}, 'cargo_puesto_id');
			dynamicDropdown("/items/{{ App\Models\Catalogo::STATUS_PERSONAL }}", 
            	{{ old('status_id', $registro->status_id ?? 0) }}, 
            	'status_id');
			dynamicDropdown("/items/{{ App\Models\Catalogo::ESTADO_CIVIL }}", 
            	{{ old('estado_civil_id', $registro->estado_civil_id ?? 0) }}, 
            	'estado_civil_id');
			dynamicDropdown("/items/{{ App\Models\Catalogo::DELEGACIONES }}", 
            	{{ old('adscripcion_id', $registro->adscripcion_id ?? 0) }}, 
            	'adscripcion_id');

			$('select[name="categoria_puestos_id"]').change(function(e){
                clearDropdown( $('select[name="cargo_puesto_id"]') );
                var optionId = $('select[name="categoria_puestos_id"] option:selected').val();
                dynamicDropdown("/items/" + optionId, 0, 'cargo_puesto_id');
            });
        });
	</script>
@endpush