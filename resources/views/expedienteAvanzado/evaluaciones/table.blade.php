
@extends('expedienteAvanzado.edit') 
@section('evaluacion_table')

    <div class="container pt-2">
        <div class="card col-md-12 badge badge-light">
            <div class="d-flex flex-row mx-2 mt-2 mb-1">
                <div class="h4 pt-1">Evaluaciones</div>
                <div class="pt-1">
                <a href="{{route('nueva_evaluacion',$persona->id)}}" 
                    class="text-success text-capitalize mx-2 justify-vertical" 
                    style="margin-top: -2px;" title="Ingresar sancion">
                    <i class="fa fa-plus-circle fa-2x pt-1"></i> 
                </a>
                </div>
                <div class="d-flex flex-row ml-auto pr-2">
                    <span class="p-1 mt-1 h6">Buscar</span>
                    <input type="text" name="search" id="search" class="col-sm-10 form-control">
                </div>
            </div>
        </div>
        <div class="card-block">            
            <div id="table-container" class="p-3 col-12">
                <table class="table table-striped" cellspacing="0" width="100%" 
                id="evaluaciones_table" data-form="deleteForm">
                    <thead class="">
                        <tr>
                            <th>Id</th>
                     
                            <th>Tipo de evaluacion</th>
                            <th>Fecha resultado</th>
                            <th>Fecha resultado</th>
                            <th>Resultado</th>
                            <th>Vigencia</th>
                           
                        
                       
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
  
@endsection
@push('scripts2')
 
    <script type="text/javascript">
        $(document).ready(function(){
            var expedientes_table = $('#evaluaciones_table').DataTable({
                // autoWidth: false,
                responsive: !0,
                searching: true,
                processing: true,
                serverSide: true,
                // stateSave -  preserva el estado del datatable, cuando el usuario regresa
                //              le muestra el datatable en el mismo estado 
                dom: '<"d-flex flex-row-reverse">t<"d-flex justify-content-between" ip>r',
                ajax: {
                        url: "{!!route('evaluaciones.list',$persona->id) !!}",
                },
                
                //scrollX: false,
                columns: [
                    {data:'id', name:'id', searchable:false},
                 
                 
                    {data:'tipo_evaluacion.name', name:'tipo_evaluacion.name', class:'text-capitalize'},
                    {data:'fecha_resultado', name:'fecha_resultado', visible:false, class:'fecha_resultado'},
                    {data:'fecha_resultado_str', name:'fecha_resultado_str',  class:"fecha_resultado_str"},
                    {data:'resultado.name', name:'resultado.name', class:'text-capitalize'},
                    {data:'tiempo_de_validez', name:'tiempo_de_validez', class:'text-capitalize'},
             
             
                   
                  
                 
                    {data:'acciones', name:'acciones', searchable:false, orderable:false,
                        render: function(data,style,row,meta){
                             return $("<div/>").html(data).text();
                         }
                    }
                ],
                order: [ 1, "desc" ]
            });
        });

        $("#search").on('keyup', function() {
            $("#evaluaciones_table").DataTable().search( this.value ).draw();
        });
    </script>
@endpush