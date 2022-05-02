


@extends('expedienteAvanzado.edit') 
@section('baja')

            <form method="POST" id="baja_form" action="{{$route}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="baja_id" id="baja_id" value="{{$baja->id ?? ''}}">
                <input type="hidden" name="persona_id" id="persona_id" value="{{$persona->id ?? ''}}">
                <input type="hidden" id="tipo_baja" 
			        	value="{{ old('tipo_baja_id', $baja->tipo_baja_id ?? 0) }}">
                <input type="hidden" id="motivo_baja" 
			        	value="{{ old('motivo_baja_id', $baja->motivo_baja_id ?? 0) }}">
                       
                       
                       



      
                <div class="form-row">
                    <div class="form-group col-md-4">
                    	<label for="tipo_baja_id">Tipo</label>
                    	<select id="tipo_baja_id" name="tipo_baja_id" 
                            class="col-md-12 browser-default custom-select">
        				</select>
                	</div>
                    <div class="form-group col-md-4">
                    	<label for="motivo_baja_id">Tipo</label>
                    	<select id="motivo_baja_id" name="motivo_baja_id" 
                            class="col-md-12 browser-default custom-select">
        				</select>
                	</div>

                    <div class="form-group col-md-4">
									<label for="fecha_baja"> Fecha baja</label>
									<input type="date" class="form-control" id="fecha_baja"  
									name="fecha_baja"   	
									value="{{ old('fecha_baja', $fecha_baja ?? '' ) }}">
								</div>
                  
                </div>
               
                    
                
                <div class="form-row">
               

          


           
    <div class="form-group col-md-4">

    <label for="acta_pdf">Acta
                      
                      </label>
    <div class="custom-file  ">
                        <input type="file" class="custom-file-input" id="acta_pdf" name="acta_pdf">
                        <label class="custom-file-label" for="acta_pdf">Elige un archivo</label>

                    
                    </div>
    </div>
    <div class="form-group col-md-2">
    <div class="icono pt-4">
            @isset($baja->acta_pdf)
                    <a class="download_file btn btn-link" title='Descargar'
       href="" media_id="{{$baja->id}}" id="acta_pdf">
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



            dynamicDropdown("/items/{{ App\Models\Catalogo::TIPO_BAJA }}", 
            	$("#tipo_baja").val(), 'tipo_baja_id');
                dynamicDropdown("/items/{{ App\Models\Catalogo::MOTIVO_BAJA }}", 
            	$("#motivo_baja").val(), 'motivo_baja_id');
             
          
                $("a.download_file").on('click', function() {
            	$media_id = $(this).attr("media_id");
              $tipo= $(this).attr("id");
            	$new_url = "/baja/" + $media_id + "/" + $tipo;
            	$("#download").attr('href',$new_url);
            	document.getElementById("download").click();
            });
		
               
          
        });
    </script>

@endpush


