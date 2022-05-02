


@extends('expedienteAvanzado.edit') 
@section('merito')

            <form method="POST" id="merito_form" action="{{$route}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="merito_id" id="merito_id" value="{{$merito->id ?? ''}}">
                <input type="hidden" name="persona_id" id="persona_id" value="{{$persona->id ?? ''}}">
              

                        <input type="hidden" id="tipo_merito" 
			        	value="{{ old('tipo_merito_id', $merito->tipo_merito_id ?? 0) }}">
                        <input type="hidden" id="merito_por" 
			        	value="{{ old('merito_por_id', $merito->merito_por_id ?? 0) }}">
                       
                       



      
                <div class="form-row">
                    <div class="form-group col-md-6">
                    	<label for="merito_por_id">Merito por</label>
                    	<select id="merito_por_id" name="merito_por_id" 
                            class="col-md-12 browser-default custom-select">
        				</select>
                	</div>

                    <div class="form-group col-md-6">
                    	<label for="tipo_merito_id">Tipo merito</label>
                    	<select id="tipo_merito_id" name="tipo_merito_id" 
                            class="col-md-12 browser-default custom-select">
        				</select>
                	</div>
               
                  
                </div>
               
                    
                
                <div class="form-row">

                <div class="form-group col-md-6">
                      <label for="folio_interno">Folio interno</label>
                      <input type="text" class="form-control" id="folio_interno"  
                        name="folio_interno" 
                        value="{{$merito->folio_interno ?? ''}}">
                    </div> 
                    <div class="form-group col-md-6">
                    	<label for="fecha_reconocimiento">Fecha de reconocimiento</label>
                        <input id="fecha_reconocimiento" name="fecha_reconocimiento" 
                            class="col-md-12 col-form" type="date"
							value="{{ old('fecha_reconocimiento', $fecha_reconocimiento ?? '' ) }}">

                            
                	</div>

                    </div>

                    <div class="form-row">
                    <div class="form-group col-md-12">
                      <label for="notas">Notas</label>
                      <input type="text" class="form-control" id="notas"  
                        name="notas" 
                        value="{{$merito->notas ?? ''}}">
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
            @isset($merito->acta_pdf)
                    <a class="download_file btn btn-link" title='Descargar'
       href="" media_id="{{$merito->id}}" id="acta_pdf">
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
            <a href="{{route('meritos',$persona->id)}}" class="nav-link">
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


            dynamicDropdown("/items/{{ App\Models\Catalogo::TIPO_MERITO }}", 
            	$("#tipo_merito").val(), 'tipo_merito_id');
                dynamicDropdown("/items/{{ App\Models\Catalogo::MERITO_POR }}", 
            	$("#merito_por").val(), 'merito_por_id');
        
          
                $("a.download_file").on('click', function() {
            	$media_id = $(this).attr("media_id");
              $tipo= $(this).attr("id");
            	$new_url = "/merito/" + $media_id + "/" + $tipo;
            	$("#download").attr('href',$new_url);
            	document.getElementById("download").click();
            });
		
               
          
        });
    </script>

@endpush


