
@extends('expedientes.edit') 
@section('documentos')

<div class="container">



  <div class="card text-center">
  <div class=" col-md-12 badge badge-light p-3 d-flex flex-row justify-content-between">
            <div class="h5">Documentos</div>
            <div class="d-flex flex-row justify-content-end">
                <div class="m-1">
                    <a  href="{!! route('personas.index') !!}" >
                        <i class="fa fa-undo fa-2x p-1 blue white-text"></i>
                    </a>
                </div>
                <div class="m-1">
                    <a  href="#"  onclick="document.getElementById('documento_form').submit();">
                        <i class="fa fa-save fa-2x p-1 orange white-text"></i>
                    </a>
                </div>
            </div>
  </div>
    <div class="card-body">

      <form action="{{route('documentos.store',$persona->id)}}" enctype="multipart/form-data"
          method="post" id="documento_form">
          @csrf

    

          <input type="hidden" id="documento_id" name="documento_id" 
            value="{{ old('id',$persona->perfil->id ?? '') }}">

        <input type="hidden" id="persona_id" name="persona_id" 
            value="{{ old('id',$persona->id ?? '') }}">



        <div class="form-row">

          <div class="form-group col-md-6">
              <div class="row">
          <div class="col-md-12">

                <label for="numero_seguro" class="float-left pl-4" >Numero seguro
                  
                </label>

</div>
                <div class="form-group col-md-12">
                <div class="custom-file col-9">
                
                  <input type="file" class="custom-file-input" id="numero_seguro" name="numero_seguro">
                  <label class="custom-file-label" for="numero_seguro">Elige un archivo</label>
                  </div>
               
                  <div class="custom-file col-2">
                  @isset($persona->perfil->numero_seguro)
                  		<a class="download_file btn btn-link" title='Descargar'
			 href="" media_id="{{$persona->id}}" id="numero_seguro">
			    	<i class="fa fa-download fa-2x text-success" aria-hidden="true"></i>
			    </a>
             @else
          <div class="download_file btn btn-link" disabled title='No hay archivo'>
			    	<i class="fa fa-download fa-2x text-light" aria-hidden="true"></i>
			    </div>
          @endisset
          </div>
     

                </div>
                     </div>
                    @if ($errors->has('numero_seguro'))
                    <strong>{{ $errors->first('numero_seguro') }}</strong>
                    @endif
          </div>

          <div class="form-group col-md-6">
              <div class="row">
          <div class="col-md-12">
                <label for="no_habilitacion" class="float-left pl-4">No habilitacion
                  
                </label>

</div>
                <div class="form-group col-md-12">
                <div class="custom-file col-9">
                
                  <input type="file" class="custom-file-input" id="no_habilitacion" name="no_habilitacion">
                  <label class="custom-file-label" for="no_habilitacion">Elige un archivo</label>
                  </div>
              
                  <div class="custom-file col-2">
                  @isset($persona->perfil->no_habilitacion)
                  		<a class="download_file btn btn-link" title='Descargar'
			 href="" media_id="{{$persona->id}}" id="no_habilitacion">
			    	<i class="fa fa-download fa-2x text-success" aria-hidden="true"></i>
			    </a>
             @else
          <div class="download_file btn btn-link" disabled title='No hay archivo'>
			    	<i class="fa fa-download fa-2x text-light" aria-hidden="true"></i>
			    </div>
          @endisset
          </div>
          

                </div>
                     </div>
                    @if ($errors->has('no_habilitacion'))
                    <strong>{{ $errors->first('no_habilitacion') }}</strong>
                    @endif
          </div>

        </div>


        <div class="form-row">

          <div class="form-group col-md-6">
              <div class="row">
          <div class="col-md-12">
                <label for="solicitud_empleo" class="float-left pl-4">Solicitud de empleo
                   
                </label>

</div>
                <div class="form-group col-md-12">
                <div class="custom-file col-9">
                
                  <input type="file" class="custom-file-input" id="solicitud_empleo" name="solicitud_empleo">
                  <label class="custom-file-label" for="solicitud_empleo">Elige un archivo</label>
                  </div>
                
                  <div class="custom-file col-2">
                  @isset($persona->perfil->solicitud_empleo)
                  		<a class="download_file btn btn-link" title='Descargar'
			 href="" media_id="{{$persona->id}}" id="solicitud_empleo">
			    	<i class="fa fa-download fa-2x text-success" aria-hidden="true"></i>
			    </a>
             @else
          <div class="download_file btn btn-link" disabled title='No hay archivo'>
			    	<i class="fa fa-download fa-2x text-light" aria-hidden="true"></i>
			    </div>
          @endisset
          </div>
  

                </div>
                     </div>
                    @if ($errors->has('solicitud_empleo'))
                    <strong>{{ $errors->first('solicitud_empleo') }}</strong>
                    @endif
          </div>

          <div class="form-group col-md-6">
              <div class="row">
          <div class="col-md-12">
                  <label for="acta_de_nacimiento" class="float-left pl-4">Acta de nacimiento
                   

                  </label>
                  </div>
                  <div class="form-group col-md-12">
                <div class="custom-file col-9">
                
                  <input type="file" class="custom-file-input" id="acta_de_nacimiento" name="acta_de_nacimiento">
                  <label class="custom-file-label" for="acta_de_nacimiento">Elige un archivo</label>
                  </div>
               
                  <div class="custom-file col-2">
                  @isset($persona->perfil->acta_de_nacimiento)
                  		<a class="download_file btn btn-link" title='Descargar'
			 href="" media_id="{{$persona->id}}" id="acta_de_nacimiento">
			    	<i class="fa fa-download fa-2x text-success" aria-hidden="true"></i>
			    </a>
             @else
          <div class="download_file btn btn-link" disabled title='No hay archivo'>
			    	<i class="fa fa-download fa-2x text-light" aria-hidden="true"></i>
			    </div>
          @endisset
          </div>
    

                </div>
                     </div>
                    @if ($errors->has('acta_de_nacimiento'))
                    <strong>{{ $errors->first('acta_de_nacimiento') }}</strong>
                    @endif
          </div>

        </div>

        <div class="form-row">

          <div class="form-group col-md-6">
          <div class="row">
          <div class="col-md-12">
                <label for="rfc" class="float-left pl-4">RFC
                
                </label>
                </div>
                <div class="form-group col-md-12">
                <div class="custom-file col-9">
                
                  <input type="file" class="custom-file-input" id="rfc" name="rfc">
                  <label class="custom-file-label" for="rfc">Elige un archivo</label>
                  </div>
                
                  <div class="custom-file col-2">
                  @isset($persona->perfil->rfc)
                  	<a class="download_file btn btn-link" title='Descargar'
			 href="" media_id="{{$persona->id}}" id="rfc">
			    	<i class="fa fa-download fa-2x text-success " aria-hidden="true"></i>
			    </a>
          @else
          <div class="download_file btn btn-link" disabled title='No hay archivo'>
			    	<i class="fa fa-download fa-2x text-light" aria-hidden="true"></i>
			    </div>
          @endisset
          </div>
          
          </div>
                </div>
                    @if ($errors->has('rfc'))
                    <strong>{{ $errors->first('rfc') }}</strong>
                    @endif
          </div>

          <div class="form-group col-md-6">
              <div class="row">
          <div class="col-md-12">
                <label for="curp" class="float-left pl-4">CURP
                
                </label>
                </div>
                <div class="form-group col-md-12">
                <div class="custom-file col-9">
                
                  <input type="file" class="custom-file-input" id="curp" name="curp">
                  <label class="custom-file-label" for="curp">Elige un archivo</label>
                  </div>
                
                  <div class="custom-file col-2">
                  @isset($persona->perfil->curp)
                  		<a class="download_file btn btn-link" title='Descargar'
			 href="" media_id="{{$persona->id}}" id="curp">
			    	<i class="fa fa-download fa-2x text-success " aria-hidden="true"></i>
			    </a>
             @else
          <div class="download_file btn btn-link" disabled title='No hay archivo'>
			    	<i class="fa fa-download fa-2x text-light" aria-hidden="true"></i>
			    </div>
          @endisset
          </div>
       

                </div>
                     </div>
                    @if ($errors->has('curp'))
                    <strong>{{ $errors->first('curp') }}</strong>
                    @endif
          </div>

        </div>


        <div class="form-row">

          <div class="form-group col-md-6">
              <div class="row">
          <div class="col-md-12">

                <label for="rfc" class="float-left pl-4">Certificado Secundaria
                 
                </label>

</div>
                <div class="form-group col-md-12">
                <div class="custom-file col-9">
                
                  <input type="file" class="custom-file-input" id="cer_secundaria" name="cer_secundaria">
                  <label class="custom-file-label" for="cer_secundaria">Elige un archivo</label>
                  </div>
             
                  <div class="custom-file col-2">
                  @isset($persona->perfil->cer_secundaria)
                  		<a class="download_file btn btn-link" title='Descargar'
			 href="" media_id="{{$persona->id}}" id="cer_secundaria">
			    	<i class="fa fa-download fa-2x text-success" aria-hidden="true"></i>
			    </a>
             @else
          <div class="download_file btn btn-link" disabled title='No hay archivo'>
			    	<i class="fa fa-download fa-2x text-light" aria-hidden="true"></i>
			    </div>
          @endisset
          </div>
       

                </div>
                     </div>
                    @if ($errors->has('cer_secundaria'))
                    <strong>{{ $errors->first('cer_secundaria') }}</strong>
                    @endif
          </div>

          <div class="form-group col-md-6">
              <div class="row">
          <div class="col-md-12">
                <label for="cer_bachillerato" class="float-left pl-4">Certificado Bachillerato
                

                </label>
                </div>
                <div class="form-group col-md-12">
                <div class="custom-file col-9">
                
                  <input type="file" class="custom-file-input" id="cer_bachillerato" name="cer_bachillerato">
                  <label class="custom-file-label" for="cer_bachillerato">Elige un archivo</label>
                  </div>
                
                  <div class="custom-file col-2">
                  @isset($persona->perfil->cer_bachillerato)
                  		<a class="download_file btn btn-link" title='Descargar'
			 href="" media_id="{{$persona->id}}" id="cer_bachillerato">
			    	<i class="fa fa-download fa-2x text-success" aria-hidden="true"></i>
			    </a>
             @else
          <div class="download_file btn btn-link" disabled title='No hay archivo'>
			    	<i class="fa fa-download fa-2x text-light" aria-hidden="true"></i>
			    </div>
          @endisset

          </div>
       
                </div>
                     </div>
                    @if ($errors->has('cer_bachillerato'))
                    <strong>{{ $errors->first('cer_bachillerato') }}</strong>
                    @endif
          </div>

        </div>

        <div class="form-row">

          <div class="form-group col-md-6">
              <div class="row">
          <div class="col-md-12">

                <label for="cer_tecnico" class="float-left pl-4">Certificado Tecnico
                 
                </label>

</div>
                <div class="form-group col-md-12">
                <div class="custom-file col-9">
                
                  <input type="file" class="custom-file-input" id="cer_tecnico" name="cer_tecnico">
                  <label class="custom-file-label" for="cer_tecnico">Elige un archivo</label>
                  </div>
                
                  <div class="custom-file col-2">
                  @isset($persona->perfil->cer_tecnico)
                  		<a class="download_file btn btn-link" title='Descargar'
			 href="" media_id="{{$persona->id}}" id="cer_tecnico">
			    	<i class="fa fa-download fa-2x text-success" aria-hidden="true"></i>
			    </a>
             @else
          <div class="download_file btn btn-link" disabled title='No hay archivo'>
			    	<i class="fa fa-download fa-2x text-light" aria-hidden="true"></i>
			    </div>
          @endisset
          </div>
         
                </div>
                     </div>
                    @if ($errors->has('cer_tecnico'))
                    <strong>{{ $errors->first('cer_tecnico') }}</strong>
                    @endif
          </div>

          <div class="form-group col-md-6">
              <div class="row">
          <div class="col-md-12">
                <label for="cer_profesional" class="float-left pl-4">Certificado Profesional
                 

                </label>
                </div>
                <div class="form-group col-md-12">
                <div class="custom-file col-9">
                
                  <input type="file" class="custom-file-input" id="cer_profesional" name="cer_profesional">
                  <label class="custom-file-label" for="cer_profesional">Elige un archivo</label>
                  </div>
               
                  <div class="custom-file col-2">
                  @isset($persona->perfil->cer_profesional)
                  		<a class="download_file btn btn-link" title='Descargar'
			 href="" media_id="{{$persona->id}}" id="cer_profesional">
			    	<i class="fa fa-download fa-2x text-success" aria-hidden="true"></i>
			    </a>
             @else
          <div class="download_file btn btn-link" disabled title='No hay archivo'>
			    	<i class="fa fa-download fa-2x text-light" aria-hidden="true"></i>
			    </div>
          @endisset
          </div>
         

                </div>
                     </div>
                    @if ($errors->has('cer_profesional'))
                    <strong>{{ $errors->first('cer_profesional') }}</strong>
                    @endif
          </div>

        </div>
        <div class="form-row">

          <div class="form-group col-md-6">
              <div class="row">
          <div class="col-md-12">
                <label for="foto_perfil" class="float-left pl-4">Foto 
                </label>
                </div>
                  <div class="form-group col-md-12">
                <div class="custom-file col-9">
                
                  <input type="file" class="custom-file-input" id="foto_perfil" name="foto_perfil">
                  <label class="custom-file-label" for="foto_perfil">Elige un archivo</label>
                  </div>
                
                  <div class="custom-file col-2">
                  @isset($persona->perfil->foto_perfil)
                  	<a class="download_file btn btn-link" title='Descargar'
			 href="" media_id="{{$persona->id}}" id="foto_perfil">
			    	<i class="fa fa-download fa-2x text-success" aria-hidden="true"></i>
			    </a>
          @else
          <div class="download_file btn btn-link" title='No hay archivo' disabled>
			    	<i class="fa fa-download fa-2x text-light" aria-hidden="true"></i>
			    </div>

          @endisset
          </div>
        

                </div>
                
                     </div>
                    @if ($errors->has('foto_perfil'))
                    <strong>{{ $errors->first('foto_perfil') }}</strong>
                    @endif
          </div>
       
          <div class="form-group col-md-6">
              <div class="row">
          <div class="col-md-12">
                  <label for="huellas" class="float-left pl-4">Huella
                     

                  </label>
                  </div>
                  <div class="form-group col-md-12">
                <div class="custom-file col-9">
                
                  <input type="file" class="custom-file-input" id="huellas" name="huellas">
                  <label class="custom-file-label" for="huellas">Elige un archivo</label>
                  </div>
               
                  <div class="custom-file col-2">
                  @isset($persona->perfil->huellas)
                  		<a class="download_file btn btn-link" title='Descargar'
			 href="" media_id="{{$persona->id}}" id="huellas">
			    	<i class="fa fa-download fa-2x text-success" aria-hidden="true"></i>
			    </a>
             @else
          <div class="download_file btn btn-link" disabled title='No hay archivo'>
			    	<i class="fa fa-download fa-2x text-light" aria-hidden="true"></i>
			    </div>
          @endisset
          </div>
         

                </div>
                       </div>
                      @if ($errors->has('huellas'))
                      <strong>{{ $errors->first('huellas') }}</strong>
                      @endif
            </div>


        </div>

        <div class="form-row">
              <div class="title form-group col-md-12">
                <div class="form-group shadow-textarea">
                      <label for="comentario">Comentario</label>
                      <textarea class="form-control z-depth-1" id="comentario"  name="comentario" rows="3">
                      {{$persona->perfil->comentario ?? ''}}
                      </textarea>
                </div>
              </div>
        </div>

     
        <a id="download" href="" style="display:none" target="_blank">Link</a>
      </form>
    </div>
    
    <div class="card-footer text-muted">
      Documentos
    </div>

  </div>



</div>			
    

@endsection
@push('scripts2')
  <script type="text/javascript">
      $(document).ready(function() {

        $("a.download_file").on('click', function() {
            	$media_id = $(this).attr("media_id");
              $tipo= $(this).attr("id");
            	$new_url = "/media/" + $media_id + "/" + $tipo;
            	$("#download").attr('href',$new_url);
            	document.getElementById("download").click();
            });
     
        });
  </script>
@endpush

