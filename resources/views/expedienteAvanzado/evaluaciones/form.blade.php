


@extends('expedienteAvanzado.edit') 
@section('evaluacion')

            <form method="POST" id="evaluacion_form" action="{{$route}}">
                @csrf
                <input type="hidden" name="evaluacion_id" id="evaluacion_id" value="{{$evaluacion->id ?? ''}}">
                <input type="hidden" name="persona_id" id="persona_id" value="{{$persona->id ?? ''}}">
                <input type="hidden" id="tipo_evaluacion" 
			        	value="{{ old('tipo_evaluacion_id', $evaluacion->tipo_evaluacion_id ?? 0) }}">
                <input type="hidden" id="resultado" 
			        	value="{{ old('resultado_id', $evaluacion->resultado_id ?? 0) }}">
                       
                       



      
                <div class="form-row">
                    <div class="form-group col-md-6">
                    	<label for="tipo_evaluacion_id">Tipo evaluacion</label>
                    	<select id="tipo_evaluacion_id" name="tipo_evaluacion_id" 
                            class="col-md-12 browser-default custom-select">
        				</select>
                	</div>

                    <div class="form-group col-md-6">
                      <label for="duracion">Duracion</label>
                      <input type="text" class="form-control" id="duracion"  
                        name="duracion" 
                        value="{{$evaluacion->duracion ?? ''}}">
                    </div> 
                </div>
               
                    
                
                <div class="form-row">
                <div class="form-group col-md-6">
                    	<label for="fecha_resultado">Fecha resultado</label>
                        <input id="fecha_resultado" name="fecha_resultado" 
                            class="col-md-12 col-form" type="date"
							value="{{ old('fecha_resultado', $fecha_resultado ?? '' ) }}">

                            
                	</div>

                    <div class="form-group col-md-6">
                    	<label for="resultado_id">Resultado</label>
                    	<select id="resultado_id" name="resultado_id" 
                            class="col-md-12 browser-default custom-select">
        				</select>
                	</div>
                </div>

                
                  
                

                
                <div class="form-row">
                <div class="form-group col-md-6">
                      <label for="tiempo_de_validez">Tiempo de validez</label>
                      <input type="text" class="form-control" id="tiempo_de_validez"  
                        name="tiempo_de_validez" 
                        value="{{$evaluacion->tiempo_de_validez ?? ''}}">
                    </div> 
                    <div class="form-group col-md-8">
                      <label for="observaciones">Observaciones</label>
                      <input type="text" class="form-control" id="observaciones"  
                        name="observaciones" 
                        value="{{$evaluacion->observaciones ?? ''}}">
                    </div> 
                </div>
              
                  
                
              

             
               
            
                <div class="pt-4 d-flex flex-row">
            
            <div class="ml-auto">
            <a href="{{route('evaluaciones',$persona->id)}}" class="nav-link">
                        <span class="badge badge-info text-white p-2 z-depth-2">
                            <i class="fa fa-undo fa-lg" aria-hidden="true"></i>
                        </span>
                    </a>
                <button class="btn btn-primary">Guardar</button>
            </div>
        </div>

            </form>
            @endsection

@push('scripts2')
	<script type="text/javascript">
		$(document).ready(function() {



            dynamicDropdown("/items/{{ App\Models\Catalogo::RESULTADO_DESEMPENO }}", 
            	$("#resultado").val(), 'resultado_id');
                dynamicDropdown("/items/{{ App\Models\Catalogo::EVALUACIONES }}", 
            	$("#tipo_evaluacion").val(), 'tipo_evaluacion_id');
          
        
		
               
          
        });
    </script>

@endpush


