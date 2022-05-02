@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card col-md-12 badge badge-light d-flex flex-row justify-content-between">
            <div class="pl-2 pt-3">
                <span class="h4 pt-1 pl-2 black-text text-capitalize">{{$title}}</span>
            </div>
            
            <div class="ml-auto d-flex flex-row p-2">
                <a href="{!! route('colegiados.index') !!}" 
                        class="m-1 p-1 badge-info z-depth-2">
                    <i class="fa fa-undo fa-2x" aria-hidden="true"></i>
                </a>
                <a href="#" class="m-1 badge-warning text-white p-1 z-depth-2"
                        onclick="document.getElementById('colegiados_form').submit();">
                    <i class="fa fa-save fa-2x" aria-hidden="true"></i>
                </a>
            </div>           
        </div> 
        <div class="mt-4">
            <form id="colegiados_form" method="POST" action="{{ $route }}" class="ml-4" enctype="multipart/form-data">

                @csrf
           

                <input type="hidden" name="colegiado_id" id="colegiado_id" value="{{$registro->id ?? ''}}">
           
                <div class="row p-1">
                    <label class="col-md-3 col-form-label text-md-right"># Oficio</label>
                    <input class="col-md-6" id="numero_oficio" type="text" name="numero_oficio" 
                        value = "{{old('numero_oficio', $registro->numero_oficio )}}" >
                </div>

                <div class="row p-1">
                 
                    <label for="fecha_solicitud" class="col-md-3 col-form-label text-md-right" > 
                            Fecha Solicitud</label>
                    <input id="fecha_solicitud" name="fecha_solicitud" 
                        class="col-md-6 col-form" type="date"
                        value="{{old('fecha_solicitud', 
	                            	isset($registro->fecha_solicitud) ?
	                            	$registro->fecha_solicitud->format('Y-m-d') : '')}}">

                </div>

                 <div class="row p-1">
                    <label class="col-md-3 col-form-label text-md-right">Motivo</label>
                    <input class="col-md-6" id="motivo" type="text" name="motivo" 
                        value = "{{ old('motivo',$registro->motivo ) }}" >
                </div>


              
                <div class="row p-1 pt-4">
          
                <label for="solicitud" class="col-md-3 col-form-label text-md-right" >Solicitud
                 

                </label>
     
               
                <div class="col-md-5 ">
                
                  <input type="file" class="custom-file-input col-md-9" id="solicitud" name="solicitud">
                  <label class="custom-file-label" for="solicitud">Elige un archivo</label>
                  </div>
               
                  <div class="col-md-2 ">
                  @isset($registro->solicitud)
                  		<a class="download_file btn btn-link" title='Descargar'
			 href="" media_id="{{$registro->id}}" id="solicitud">
			    	<i class="fa fa-download fa-2x text-success" aria-hidden="true"></i>
			    </a>
             @else
          <div class="download_file btn btn-link" disabled title='No hay archivo'>
			    	<i class="fa fa-download fa-2x text-light" aria-hidden="true"></i>
			    </div>
          @endisset
          </div>
         

                
                    
                    @if ($errors->has('solicitud'))
                    <strong>{{ $errors->first('solicitud') }}</strong>
                    @endif
                    </div>

                  

                    <div class="row p-1">
          
          <label for="respuesta" class="col-md-3 col-form-label text-md-right" >Respuesta
           

          </label>

         
          <div class="col-md-5 ">
          
            <input type="file" class="custom-file-input col-md-9" id="respuesta" name="respuesta">
            <label class="custom-file-label" for="respuesta">Elige un archivo</label>
            </div>
         
            <div class="col-md-2 ">
            @isset($registro->respuesta)
                    <a class="download_file btn btn-link" title='Descargar'
       href="" media_id="{{$registro->id}}" id="respuesta">
              <i class="fa fa-download fa-2x text-success" aria-hidden="true"></i>
          </a>
       @else
    <div class="download_file btn btn-link" disabled title='No hay archivo'>
              <i class="fa fa-download fa-2x text-light" aria-hidden="true"></i>
          </div>
    @endisset
    </div>
   

          
              
              @if ($errors->has('respuesta'))
              <strong>{{ $errors->first('respuesta') }}</strong>
              @endif
              </div>

              @isset($registro->respuesta)
              <div class="row p-1">
          
          <label for="resultado" class="col-md-3 col-form-label text-md-right" >Resultado
           

          </label>

         
          <div class="col-md-5 ">
          
            <input type="file" class="custom-file-input col-md-9" id="resultado" name="resultado">
            <label class="custom-file-label" for="resultado">Elige un archivo</label>
            </div>
         
            <div class="col-md-2 ">
            @isset($registro->resultado)
                    <a class="download_file btn btn-link" title='Descargar'
       href="" media_id="{{$registro->id}}" id="resultado">
              <i class="fa fa-download fa-2x text-success" aria-hidden="true"></i>
          </a>
       @else
    <div class="download_file btn btn-link" disabled title='No hay archivo'>
              <i class="fa fa-download fa-2x text-light" aria-hidden="true"></i>
          </div>
    @endisset
    </div>
   

          
              
              @if ($errors->has('resultado'))
              <strong>{{ $errors->first('resultado') }}</strong>
              @endif
              </div>
              @endisset
              <div class="row p-1 pb-4">
               
                      <label for="notas" class="col-md-3 col-form-label text-md-right">Notas</label>
                      <textarea class="form-control z-depth-1 col-md-6" id="notas"  name="notas" rows="3">
                      {{ old('notas',$registro->notas ) }}
                      </textarea>
          
            
        </div>

       

                   

                
                <a id="download" href="" style="display:none" target="_blank">Link</a>
            </form>
        </div>
    </div>
@endsection

@push('scripts2')
  <script type="text/javascript">
      $(document).ready(function() {

        $("a.download_file").on('click', function() {
            	$media_id = $(this).attr("media_id");
              $tipo= $(this).attr("id");
            	$new_url = "/colegiado/" + $media_id + "/" + $tipo;
            	$("#download").attr('href',$new_url);
            	document.getElementById("download").click();
            });
     
        });
  </script>
@endpush
