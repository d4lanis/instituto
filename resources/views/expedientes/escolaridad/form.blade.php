
@extends('expedientes.edit') 
@section('escolaridad')
 
      
     
                <form method="POST" id="escolaridad_form" action="{{$route}}" >
                @csrf
                <input type="hidden" name="escolaridad_id" id="escolaridad_id" value="{{$escolaridad->id ?? ''}}">
                <input type="hidden" name="persona_id" id="persona_id" value="{{$persona->id ?? ''}}">
                <input type="hidden" id="nivel_escolar" 
			        	value="{{ old('nivel_escolar_id', $escolaridad->nivel_escolar_id ?? 0) }}">
                        <input type="hidden" id="estatus" 
			        	value="{{ old('estatus_id', $escolaridad->estatus_id ?? 0) }}">



                        <div class="form-row">

                        <div class="form-group col-md-6">
                      <label for="nombre_de_estudio">Nombre de estudio</label>
                      <input type="text" class="form-control" id="nombre_de_estudio"  
                        name="nombre_de_estudio" 
                        value="{{ old('estatus_id',$escolaridad->nombre_de_estudio ?? '')}}">
                    </div> 

                    <div class="form-group col-md-6">
                      <label for="nombre_de_institucion">Nombre de institucion</label>
                      <input type="text" class="form-control" id="nombre_de_institucion"  
                        name="nombre_de_institucion" 
                        value="{{ old('estatus_id',$escolaridad->nombre_de_institucion ?? '')}}">
                    </div> 
                   
                  
                </div>

                <div class="form-row">
                <div class="form-group col-md-6">
                    	<label for="nivel_escolar_id">Nivel escolar</label>
                    	<select id="nivel_escolar_id" name="nivel_escolar_id" 
                            class="col-md-12 browser-default custom-select">
        				</select>
                	</div>

                    <div class="form-group col-md-6">
                    	<label for="estatus_id">Estatus escolar</label>
                    	<select id="estatus_id" name="estatus_id" 
                            class="col-md-12 browser-default custom-select">
        				</select>
                	</div>
                  
                
                </div>
                
                <div class="form-row">
                <div class="form-group col-md-6">
                    	<label for="fecha_inicio">Fecha de inicio</label>
                        <input id="fecha_inicio" name="fecha_inicio" 
                            class="col-md-12 col-form" type="integer"
							value="{{ old('fecha_inicio', $escolaridad->fecha_inicio ?? Carbon\Carbon::now()->year ) }}">

                            
                	</div>


                    <div class="form-group col-md-6">
                    	<label for="fecha_conclusion">Fecha de Conclusión</label>
                        <input id="fecha_conclusion" name="fecha_conclusion" 
                            class="col-md-12 col-form" type="integer"
							value="{{ old('fecha_conclusion', $escolaridad->fecha_conclusion ?? Carbon\Carbon::now()->year ) }}">

                            
                	</div>
                </div>
                <div class="pt-4 d-flex flex-row">
            
            <div class="ml-auto">
            <a href="{{route('estudios',$persona->id)}}" class="nav-link">
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
            dynamicDropdown("/items/{{ App\Models\Catalogo::NIVEL_ESCOLAR }}", 
            	$("#nivel_escolar").val(), 'nivel_escolar_id');
            dynamicDropdown("/items/{{ App\Models\Catalogo::ESTATUS_ESCOLAR }}", 
            	$("#estatus").val(), 'estatus_id');
				
         
        });
    </script>

@endpush


