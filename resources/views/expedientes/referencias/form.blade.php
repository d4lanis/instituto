
@extends('expedientes.edit') 
@section('referencias')

<form method="POST" id="referencias_form" action="{{$route}}">			
       
     
       @csrf
      
	
       <input type="hidden" name="referencia_id" id="referencia_id" value="{{$referencia->id ?? ''}}">
       <input type="hidden" name="persona_id" id="persona_id" value="{{$persona->id ?? ''}}">
                <input type="hidden" name="sexo" id="sexo" value="{{ old('sexo_id', $referencia->sexo_id ?? 0) }}">
                <input type="hidden" name="parentesco" id="parentesco" value="{{ old('parentesco_id', $referencia->parentesco_id ?? 0) }}">

      

               
               
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="paterno_referencia">Apellido Paterno</label>
                      <input type="text" class="form-control" id="paterno_referencia"  name="paterno_referencia" value="{{ old('paterno_referencia',$referencia->paterno_referencia ?? '')}}">
                    </div> 
                    <div class="form-group col-md-6">
                      <label for="materno_referencia">Apellido Materno</label>
                      <input type="text" class="form-control" id="materno_referencia"  name="materno_referencia" value="{{ old('materno_referencia',$referencia->materno_referencia ?? '')}}">
                    </div> 
                </div>

                

                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="nombre_referencia">Nombre(s)</label>
                      <input type="text" class="form-control" id="nombre_referencia"  
                        name="nombre_referencia" value="{{ old('nombre_referencia',$referencia->nombre_referencia ?? '')}}">
                    </div>

                    <div class="form-group col-md-5">
                    	<label for="sexo">Sexo</label>
                    	<select id="sexo_id" name="sexo_id" 
                            class="col-md-8 browser-default custom-select">
        				</select>
                	</div>
                </div>
                       
                <div class="form-row">
                <div class="form-group col-md-6">
                    	<label for="parentesco">Parentesco</label>
                    	<select id="parentesco_id" name="parentesco_id" 
                            class="col-md-12 browser-default custom-select">
        				</select>
                	</div>
                    <div class="col-md-6">
                    <label for="ocupacion_referencia">Ocupacion</label>
                      <input type="text" class="form-control" id="ocupacion_referencia"  
                            name="ocupacion_referencia" value="{{ old('ocupacion_referencia',$referencia->ocupacion_referencia ?? '')}}">
                    </div> 
                </div>

                <div class="pt-4 d-flex flex-row">
            
            <div class="ml-auto">
            <a href="{{route('referencia',$persona->id)}}" class="nav-link">
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
            dynamicDropdown("/items/{{ App\Models\Catalogo::SEXO }}", 
            	$("#sexo").val(), 'sexo_id');
            dynamicDropdown("/items/{{ App\Models\Catalogo::PARENTESCO }}", 
            	$("#parentesco").val(), 'parentesco_id');
				
         
        });
    </script>

@endpush