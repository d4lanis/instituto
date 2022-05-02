@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card col-md-12 badge badge-light d-flex flex-row justify-content-between">
            <div class="pl-2 pt-3">
                <span class="h4 pt-1 pl-2 black-text text-capitalize">{{$title}}</span>
            </div>
            
            <div class="ml-auto d-flex flex-row p-2">
                <a href="{!! route('eventos.index') !!}" 
                        class="m-1 p-1 badge-info z-depth-2">
                    <i class="fa fa-undo fa-2x" aria-hidden="true"></i>
                </a>
                <a href="#" class="m-1 badge-warning text-white p-1 z-depth-2"
                        onclick="document.getElementById('eventos_form').submit();">
                    <i class="fa fa-save fa-2x" aria-hidden="true"></i>
                </a>
            </div>           
        </div> 
        <div class="mt-4">
            <form id="eventos_form" method="POST" action="{{ $route }}" class="ml-4" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="evento_id" id="evento_id" value="{{$registro->id ?? ''}}">
                <div class="col-md-12 ">
				
                    <div class="form-row ">

                        <div class="form-group col-md-3 ">
                            <label for="numero_oficio"># Oficio</label>
                            <input class="form-control" id="numero_oficio" type="text" name="numero_oficio" 
                                value = "{{old('numero_oficio', $registro->numero_oficio )}}" >
                        </div>

                        <div class="form-group col-md-6 ">
                            <label for="titulo">Titulo</label>
                            <input class="form-control" id="titulo" type="text" name="titulo" 
                                value = "{{old('titulo', $registro->titulo )}}" >
                        </div>


                        <div class="form-group col-md-3 ">
                            <label for="fecha_evento"  > 
                                    Fecha de evento</label>
                            <input id="fecha_evento" name="fecha_evento" 
                                class="form-control" type="date"
                                value="{{old('fecha_evento', 
                                            isset($registro->fecha_evento) ?
                                            $registro->fecha_evento->format('Y-m-d') : '')}}">
                        </div>

                        
                    </div>

                    <div class="row p-1 pb-4">
                        <div class="form-group col-md-6">
                                <label for="oficio"  >Oficio</label>
                            <div class=" col-12 ">
                    
                        <input type="file" class="custom-file-input col-md-8" id="oficio" name="oficio">
                        <label class="custom-file-label col-md-8" for="oficio">Elige un archivo</label>
                    
                    
                        <div class="col-md-4 float-right ">
                            @isset($registro->oficio)
                                <a class="download_file btn btn-link" title='Descargar'
                                    href="" media_id="{{$registro->id}}" id="oficio">
                                    <i class="fa fa-download fa-2x text-success" aria-hidden="true"></i>
                                </a>
                            @else
                                <div class="download_file btn btn-link" disabled title='No hay archivo'>
                                    <i class="fa fa-download fa-2x text-light" aria-hidden="true"></i>
                                </div>
                            @endisset
                        </div>
            
                            </div>
                    
                        
                        @if ($errors->has('oficio'))
                        <strong>{{ $errors->first('oficio') }}</strong>
                        @endif
                            </div>

                    </div>

                    <div class="row p-1 pb-4">
               
                      <label for="descripcion" >Descripcion</label>
                      <textarea class="form-control z-depth-1 " id="descripcion"  name="descripcion" rows="12">
                      {{ old('descripcion',$registro->descripcion ) }}
                      </textarea>
          
            
                    </div>

                </div>


            <a id="download" href="" style="display:none" target="_blank">Link</a>
        </div>
            </form>
    </div>
   
@endsection

@push('scripts2')
  <script type="text/javascript">
      $(document).ready(function() {

        $("a.download_file").on('click', function() {
            	$media_id = $(this).attr("media_id");
              $tipo= $(this).attr("id");
            	$new_url = "/evento/" + $media_id + "/" + $tipo;
            	$("#download").attr('href',$new_url);
            	document.getElementById("download").click();
            });
     
        });
  </script>
@endpush
