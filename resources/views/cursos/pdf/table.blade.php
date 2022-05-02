@extends('layouts.master')

@section('content')
    <div class="container">
    <div class="card mb-4">
    <div class="card-header badge-light">
    <div class="row">
  <div class="col-md-6 align-middle text-center pt-2">   {{$curso->nombre}}</div>
  <div class="col-md-3 offset-md-3">
  <form id="x_form" method="POST" action="#"  >
  <a href="#" class="px-1" title="Diploma" id="save_diploma" target="_blank"> 
            
              
            <!-- <span class="pl-1  text-uppercase">  Diploma</span> -->
            <button  type="submit" value=" Diploma" name="diploma" class="btn btn-primary btn-sm">
            <i class="fa fa-file-text fa-2x align-middle"> Diploma</i>
            </button>
           
           
</a>



    <a href="#" class="px-1" title="Kardex" id="save_kardex">
    <button  type="submit" value="kardex" name="kardex" class="btn btn-primary btn-sm">
            <i class="fa fa-file-text fa-2x align-middle"> Kardex</i>
            </button>
    </a>
</div>
</div>
   
    </div>
    <div class="card-body">
        <div class="table-responsive" >
       
        <div class="form-check">
                    <input class="form-check-input" type="checkbox" 
                     id="roles_0" name="default" value="0" >
                    <label class="form-check-label text-uppercase" for="roles_0">
                       Selecciona todos
                    </label>
                </div>
            @foreach ($curso->alumnos as $alumno)
                <div class="form-check personas" id="form-check-1">
                    <input class="form-check-input" type="checkbox" 
                    value="{{$alumno->id}}" id="roles_{{$alumno->id}}" name="roles[]"
                    
                   >
                    <label class="form-check-label text-uppercase" for="roles_{{$alumno->id}}">
                        {{$alumno->alumno->fullname}}
                    </label>
                </div>
                
            @endforeach

          

            </form>
     
        </div>
    </div>
</div>
    </div>
@endsection
@push('scripts2')
  <script type="text/javascript">
    $(document).ready(function() {
       $("#roles_0").click(function(){
           $("#form-check-1 input[type='checkbox']").prop('checked',this.checked);
       });

       $( "#save_diploma" ).click(function() {
        $("#x_form").on('submit', function(e){
        e.preventDefault();
            var alumnos_asignados = [];
            
        
            // $('div.personas input[type=checkbox]').each(function () {
            //         alumnos_asignados.push( $(this).val() );
            // });

            $.each($("input[name='roles[]']:checked"), function(){            
                alumnos_asignados.push($(this).val());
            });
            
            if (alumnos_asignados.length == 0) return false;
            //alert("items" + alumnos_asignados.join());
            let data = {
                alumnos_asignados : alumnos_asignados.join(),
               
                curso_seleccionado:{{$curso->id}}
            }
            console.log(data);
 
            $.ajax({

            type: 'POST',

            url: '{{route('diploma',$curso)}}',

            data: data,

            xhrFields: {

                responseType: 'blob'

            },

            success: function(response){

                var blob = new Blob([response]);

                var link = document.createElement('a');
        
                link.href = window.URL.createObjectURL(blob);

                link.download = "Documento.pdf";

                link.click();

            },

            error: function(blob){

                console.log(blob);

            }

            });

});
});
     

$( "#save_kardex" ).click(function() {
$("#x_form").on('submit', function(e){
        e.preventDefault();
            var alumnos_asignados = [];
            
        
            // $('div.personas input[type=checkbox]').each(function () {
            //         alumnos_asignados.push( $(this).val() );
            // });

            $.each($("input[name='roles[]']:checked"), function(){            
                alumnos_asignados.push($(this).val());
            });
            
            if (alumnos_asignados.length == 0) return false;
            //alert("items" + alumnos_asignados.join());
            let data = {
                alumnos_asignados : alumnos_asignados.join(),
               
                curso_seleccionado:{{$curso->id}}
            }
            console.log(data);
 
            $.ajax({

            type: 'POST',

            url: '{{route('kardex',$curso)}}',

            data: data,

            xhrFields: {

                responseType: 'blob'

            },

            success: function(response){

                var blob = new Blob([response]);

                var link = document.createElement('a');
        
                link.href = window.URL.createObjectURL(blob);

                link.download = "Documento.pdf";

                link.click();

            },

            error: function(blob){

                console.log(blob);

            }

            });

});
});
});

  </script>
@endpush