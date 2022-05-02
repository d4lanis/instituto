
@extends('expedientes.edit') 
@section('nombramiento')
 
      
     
                <form method="POST" id="nombramiento_form" action="{{$route}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="nombramiento_id" id="nombramiento_id" value="{{$nombramiento->id ?? ''}}">
                <input type="hidden" name="persona_id" id="persona_id" value="{{$persona->id ?? ''}}">
                <!-- <input type="hidden" id="nivel_escolar" 
			        	value="{{ old('nivel_escolar_id', $nombramiento->nivel_escolar_id ?? 0) }}"> -->
                       



                        <div class="form-row">
                        <div class="form-group col-md-3">
									<label for="fecha_inicio"> Fecha de inicio</label>
									<input type="date" class="form-control" id="fecha_inicio"  
									name="fecha_inicio"   	
									value="{{old('fecha_inicio', isset($nombramiento->fecha_inicio) ?
											$nombramiento->fecha_inicio->format('Y-m-d') : '')}}">
					</div>
                        <div class="form-group col-md-5">
                      <label for="nombre_cargo_grado">Nombre de cargo o grado</label>
                      <input type="text" class="form-control" id="nombre_cargo_grado"  
                        name="nombre_cargo_grado" 
                        value="{{ old('nombre_cargo_grado',$nombramiento->nombre_cargo_grado ?? '')}}">
                    </div> 
                   
                    <div class="form-group col-md-4">
                      <label for="area_adscripcion">Area de adscripcion</label>
                      <input type="text" class="form-control" id="area_adscripcion"  
                        name="area_adscripcion" 
                        value="{{ old('area_adscripcion',$nombramiento->area_adscripcion ?? '')}}">
                    </div> 
                    <!-- <div class="form-group col-md-6">
                    	<label for="estatus_id">Estatus escolar</label>
                    	<select id="estatus_id" name="estatus_id" 
                            class="col-md-12 browser-default custom-select">
        				</select>
                	</div> -->
                    
                  
                </div>

                <div class="form-row">
                <div class="form-group col-md-3">
                      <label for="promedio">Calificacion de formacion inicial</label>
                      <input type="text" class="form-control" id="promedio"  
                        name="promedio" 
                        value="{{ old('promedio',$nombramiento->promedio ?? '')}}">
                    </div> 
                    <div class="form-group col-md-5">
                      <label for="nombre_documento_certifica">Nombre del documento que lo certifica</label>
                      <input type="text" class="form-control" id="nombre_documento_certifica"  
                        name="nombre_documento_certifica" 
                        value="{{ old('nombre_documento_certifica',$nombramiento->nombre_documento_certifica ?? '')}}">
                    </div> 

                <div class="form-group col-md-3">

                    <label for="documento_pdf">Documento</label>
                        <div class="custom-file  ">
                        <input type="file" class="custom-file-input" id="documento_pdf" name="documento_pdf">
                        <label class="custom-file-label" for="documento_pdf">Elige un archivo</label>

                
                        </div>
                </div>
                <div class="form-group col-md-1">
                <div class="icono pt-4">
                        @isset($nombramiento->documento_pdf)
                                <a class="download_file btn btn-link" title='Descargar'
                href="" media_id="{{$nombramiento->id}}" id="documento_pdf">
                        <i class="fa fa-download fa-2x text-success" aria-hidden="true"></i>
                    </a>
                @else
                <div class="download_file btn btn-link" disabled title='No hay archivo'>
                        <i class="fa fa-download fa-2x text-light" aria-hidden="true"></i>
                    </div>
                @endisset
                </div>
                </div>

                @if ($errors->has('documento_pdf'))
                                    <strong>{{ $errors->first('documento_pdf') }}</strong>
                                    @endif
                  
                
                </div>
                
             
                <div class="pt-4 d-flex flex-row">
            
            <div class="ml-auto">
            <a href="{{route('nombramientos',$persona->id)}}" class="nav-link">
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
            // dynamicDropdown("/items/{{ App\Models\Catalogo::NIVEL_ESCOLAR }}", 
            // 	$("#nivel_escolar").val(), 'nivel_escolar_id');

            $("a.download_file").on('click', function() {
            	$media_id = $(this).attr("media_id");
              $tipo= $(this).attr("id");
            	$new_url = "/nombramiento/" + $media_id + "/" + $tipo;
            	$("#download").attr('href',$new_url);
            	document.getElementById("download").click();
            });
         
        });
    </script>

@endpush


