


@extends('expedienteAvanzado.edit') 
@section('cambio')

            <form method="POST" id="cambio_form" action="{{$route}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="cambio_id" id="cambio_id" value="{{$cambio->id ?? ''}}">
                <input type="hidden" name="persona_id" id="persona_id" value="{{$persona->id ?? ''}}">
                <input type="hidden" id="motivo_cambio" 
			        	value="{{ old('motivo_cambio_id', $cambio->motivo_cambio_id ?? 0) }}">
                <input type="hidden" id="puesto" 
			        	value="{{ old('puesto_id', $cambio->puesto_id ?? 0) }}">
                        <input type="hidden" id="puesto_nuevo" 
			        	value="{{ old('puesto_nuevo_id', $cambio->puesto_nuevo_id ?? 0) }}">
                       
                       



      
                <div class="form-row">
                    <div class="form-group col-md-6">
                    	<label for="motivo_cambio_id">Motivo</label>
                    	<select id="motivo_cambio_id" name="motivo_cambio_id" 
                            class="col-md-12 browser-default custom-select">
        				</select>
                	</div>
                    <div class="form-group col-md-6">
                    	<label for="fecha_cambio">Fecha cambio</label>
                        <input id="fecha_cambio" name="fecha_cambio" 
                            class="col-md-12 form-control" type="date"
							value="{{ old('fecha_cambio', $fecha_cambio ?? '' ) }}">

                            
                	</div>
                  
                </div>
               
                    
                
                <div class="form-row">
               

                    <div class="form-group col-md-6">
                    	<label for="puesto_id">Puesto</label>
                    	<select id="puesto_id" name="puesto_id" 
                            class="col-md-12 browser-default custom-select">
        				</select>
                	</div>

                    <div class="form-group col-md-6">
                    	<label for="puesto_nuevo_id">Puesto nuevo</label>
                    	<select id="puesto_nuevo_id" name="puesto_nuevo_id" 
                            class="col-md-12 browser-default custom-select">
        				</select>
                	</div>
                </div>

                
                  
                

                <div class="form-row">
    <div class="form-group col-md-6">

    <label for="acta_pdf">Acta
                      
                      </label>
    <div class="custom-file  ">
                        <input type="file" class="custom-file-input" id="acta_pdf" name="acta_pdf">
                        <label class="custom-file-label" for="acta_pdf">Elige un archivo</label>

                    
                    </div>
    </div>
    <div class="form-group col-md-6">
    <div class="icono pt-4">
            @isset($cambio->acta_pdf)
                    <a class="download_file btn btn-link" title='Descargar'
       href="" media_id="{{$cambio->id}}" id="acta_pdf">
              <i class="fa fa-download fa-2x text-success" aria-hidden="true"></i>
          </a>
       @else
    <div class="download_file btn btn-link" disabled title='No hay archivo'>
              <i class="fa fa-download fa-2x text-light" aria-hidden="true"></i>
          </div>
    @endisset
    </div>
    </div>

    @if ($errors->has('acta_pdf'))
                        <strong>{{ $errors->first('acta_pdf') }}</strong>
                        @endif
  </div>
              
                  
                
              

             
               
            
                <div class="pt-4 d-flex flex-row">
            
            <div class="ml-auto">
            <a href="{{route('cambios',$persona->id)}}" class="nav-link">
                        <span class="badge badge-info text-white p-2 z-depth-2">
                            <i class="fa fa-undo fa-lg" aria-hidden="true"></i>
                        </span>
                    </a>
                <button class="btn btn-primary">Guardar</button>
            </div>
        </div>
        <a id="download" href="" style="display:none" target="_blank">Link</a>
            </form>
            @endsection

@push('scripts2')
	<script type="text/javascript">
		$(document).ready(function() {



            dynamicDropdown("/items/{{ App\Models\Catalogo::MOTIVO_CAMBIO }}", 
            	$("#motivo_cambio").val(), 'motivo_cambio_id');
                dynamicDropdown("/items/{{ App\Models\Catalogo::CATEGORIA_PUESTOS }}", 
            	$("#puesto").val(), 'puesto_id');
                dynamicDropdown("/items/{{ App\Models\Catalogo::CATEGORIA_PUESTOS }}", 
            	$("#puesto_nuevo").val(), 'puesto_nuevo_id');
          
        
                $("a.download_file").on('click', function() {
            	$media_id = $(this).attr("media_id");
              $tipo= $(this).attr("id");
            	$new_url = "/cambio/" + $media_id + "/" + $tipo;
            	$("#download").attr('href',$new_url);
            	document.getElementById("download").click();
            });
               
          
        });
    </script>

@endpush


