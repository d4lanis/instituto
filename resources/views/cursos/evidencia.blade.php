@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card col-md-12 badge badge-light d-flex flex-row justify-content-between">
            <div class="pl-2 pt-3">
                <span class="h4 pt-1 pl-2 black-text text-capitalize">{{$title}}</span>
            </div>
            
            <div class="ml-auto d-flex flex-row p-2">
             
         
 
      
                <form id="evidencia_form" method="POST" action="#"  
                        enctype="multipart/form-data" multiple accept="image/*">
            
                    @csrf
                  

                    <input type="file" name="image[]" id="image" class="form-control-image" 
                    multiple accept="image/*">

                   

                    <a class="btn_image_save" href="#" >
                    <input type="submit" value="Subir imagenes" class="btn btn-primary btn-sm">
                    </a>

                
                
                </form>
      


                 
                <a href="{!! route('cursos.index') !!}" class="pl-2 pt-1">
                <h4>
                <span class="badge badge-info badge-pill"><i class="fa fa-undo " ></i> </span>
                </h4>
                </a>
                
            </div>           
        </div> 
       <div class="conatiner mt-2">
       <div id="uploadStatus"></div>
       <div class="row" id="gridimages">

      
  <!-- Gallery view of uploaded images --> 

                   
                            @forelse($curso->evidencias as $evidencia)
                            <div class="col-md-4 p-3">
                            <div class="card">
                            <img src="{{asset($evidencia->imagen)}}" alt="enlace roto"
                            class="card-img-top">
                            
                            <div class="card-body d-flex">
                            @if( $curso->status_curso != 1 )
                            <form action="{!! route('evidencia.delete',$evidencia->id) !!}" method="GET">
                            @csrf
                            <input type="submit" value="delete" class="btn btn-danger btn-sm">
                           
                            </form>
                           @endif
                                 <div class="icono ">
                       
                                <a class="download_file btn btn-success btn-sm" title='Descargar'
                                    href="" media_id="{{$evidencia->id}}" id="imagen">Descargar
                       
                                </a>
             
                                </div>
                          
                            </div>
                            </div>
                           
                            </div>
                            @empty
                            <label for="informe" class="p-3">
                            <em>No se han subido imagenes</em> 
                            </label>
                           
                          @endforelse
                          </div>
                <!-- <div class="row justify-content-center">
                {{--$images->links()--}}
                </div> -->
                <a id="download" href="" style="display:none" target="_blank">Link</a>
       
       </div>
    </div>
@endsection
@push('scripts2')
  <script type="text/javascript">
    $(document).ready(function() {
        $("#evidencia_form").on('submit', function(e){
        e.preventDefault();
       
        $.ajax({
            type: 'POST',
            url: '{{route('evidencia.store', $curso->id)}}',
            data: new FormData(this), 
            contentType: false,
            cache: false,
            processData:false,
          
            error:function(){
                $('#uploadStatus').html('<span style="color:#EA4335;">Error al subir imagenes.<span>');
            },
            success: function(data){
                $('#evidencia_form')[0].reset();
                $('#uploadStatus').html('<span style="color:#28A74B;">Imagenes subidas exitosamente.<span>');
                $('#gridimages').load(' #gridimages');
                // console.log(data);
            }

        });


       
        });
        $("#image").change(function(){
        var fileLength = this.files.length;
        var match= ["image/jpeg","image/png","image/jpg","image/gif"];
        var i;
        for(i = 0; i < fileLength; i++){ 
            var file = this.files[i];
            var imagefile = file.type;
            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3]))){
                alert('Selecciona un archivo correcto (JPEG/JPG/PNG/GIF).');
                $("#image").val('');
                return false;
            }
        }
    });
      
    $("a.download_file").on('click', function() {
            	$media_id = $(this).attr("media_id");
              $tipo= $(this).attr("id");
            	$new_url = "/descargar/" + $media_id + "/" + $tipo;
            	$("#download").attr('href',$new_url);
            	document.getElementById("download").click();
            });
    });
  </script>
@endpush