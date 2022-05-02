


@extends('expedienteAvanzado.edit') 
@section('sanciones')


      
    
            <form method="POST" id="sancion_form" action="{{$route}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="sancion_id" id="sancion_id" value="{{$sancion->id ?? ''}}">
                <input type="hidden" name="persona_id" id="persona_id" value="{{$persona->id ?? ''}}">
              
                        <input type="hidden" id="tipo_sancion" 
			        	value="{{ old('tipo_sancion_id', $sancion->tipo_sancion_id ?? 0) }}">
                        <input type="hidden" id="estado_sancion" 
			        	value="{{ old('estado_sancion_id', $sancion->estado_sancion_id ?? 0) }}">
                       

                       

      
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="origen_queja_id">Origen Queja</label>
                      <input type="text" class="form-control" id="origen_queja_id"  
                        name="origen_queja_id" 
                        value="{{ old('origen_queja_id',$sancion->origen_queja_id ?? '')}}">
                    </div> 

                    <div class="form-group col-md-6">
                      <label for="tipo_queja_id">Origen Sancion</label>
                      <input type="text" class="form-control" id="tipo_queja_id"  
                        name="tipo_queja_id" 
                        value="{{ old('tipo_queja_id',$sancion->tipo_queja_id ?? '')}}">
                    </div> 
                </div>
               
                    
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="folio_interno">Folio interno</label>
                      <input type="text" class="form-control" id="folio_interno"  
                        name="folio_interno" 
                        value="{{ old('folio_interno', $sancion->folio_interno ?? '')}}">
                    </div> 

                    <div class="form-group col-md-6">
                      <label for="asunto">Asunto</label>
                      <input type="text" class="form-control" id="asunto"  
                        name="asunto" 
                        value="{{ old('asunto', $sancion->asunto ?? '')}}">
                    </div> 
                </div>

                
                  
                

                
                <div class="form-row">
                    <div class="form-group col-md-6">
                    	<label for="tipo_sancion_id">Tipo Sancion</label>
                    	<select id="tipo_sancion_id" name="tipo_sancion_id" 
                            class="col-md-12 browser-default custom-select">
        				</select>
                	</div>
                    <div class="form-group col-md-6">
                    	<label for="estado_sancion_id">Estado Sancion</label>
                    	<select id="estado_sancion_id" name="estado_sancion_id" 
                            class="col-md-12 browser-default custom-select">
        				</select>
                	</div>
                </div>
              
                  
                
              

                <div class="form-row">
                    <div class="form-group col-md-6">
                    	<label for="fecha_inicio">  Fecha inicio</label>
                        <input id="fecha_inicio" name="fecha_inicio" 
                            class="col-md-12 col-form" type="date"

                            

							value="{{ old('fecha_inicio', $fecha_inicio ) }}">
                       
                	</div>


                    <div class="form-group col-md-6">
                    	<label for="fecha_termino">  Fecha Termino</label>
                        <input id="fecha_termino" name="fecha_termino" 
                            class="col-md-12 col-form" type="date"
							value="{{ old('fecha_termino', $fecha_termino ) }}">

                            
                	</div>
               
                </div>
              
               
                
                <div class="form-row">
                    <div class="form-group col-md-8">
                      <label for="notas">Notas</label>
                      <input type="text" class="form-control" id="notas"  
                        name="notas" 
                        value="{{$sancion->notas ?? ''}}">
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
            @isset($sancion->acta_pdf)
                    <a class="download_file btn btn-link" title='Descargar'
       href="" media_id="{{$sancion->id}}" id="acta_pdf">
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
            <a href="{{route('sanciones',$persona->id)}}" class="nav-link">
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



           
                dynamicDropdown("/items/{{ App\Models\Catalogo::TIPO_SANCION }}", 
            	$("#tipo_sancion").val(), 'tipo_sancion_id');
                dynamicDropdown("/items/{{ App\Models\Catalogo::ESTADO_SANCION }}", 
            	$("#estado_sancion").val(), 'estado_sancion_id');
        
		
                $("a.download_file").on('click', function() {
            	$media_id = $(this).attr("media_id");
              $tipo= $(this).attr("id");
            	$new_url = "/sancion/" + $media_id + "/" + $tipo;
            	$("#download").attr('href',$new_url);
            	document.getElementById("download").click();
            });
          
        });
    </script>

@endpush


