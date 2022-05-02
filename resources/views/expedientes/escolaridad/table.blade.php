@extends('expedientes.edit') 
@section('escolaridad_table')
    <div class="container pt-2">
        <div class="card col-md-12 badge badge-light">
            <div class="d-flex flex-row mx-2 mt-2 mb-1">
                <div class="h4 pt-1">Escolaridad</div>
                <div class="pt-1">
                <a href="{{route('estudios.create',$persona->id)}}" 
                    class="text-success text-capitalize mx-2 justify-vertical" 
                    style="margin-top: -2px;" title="Ingresar estudio">
                    <i class="fa fa-plus-circle fa-2x pt-1"></i> 
                </a>
                    <!-- <a href="#" 
                        class="text-success text-capitalize mx-2 justify-vertical" 
                        style="margin-top: -2px;" id="open_model_escolaridad" title="Ingresar estudios" data-toggle="modal" data-target="#modal_escolaridad_form"> 
                        <i class="fa fa-plus-circle fa-2x pt-1"></i> 
                    </a> -->
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
                id="escolaridad_table" data-form="deleteForm">
                    <thead class="">
                        <tr>
                            <th>Id</th>
                            <th>Nombre de Estudio</th>
                            <th>Nombre de Institución</th>
                         
                            <th>Año de inicio</th>
                            <th>Año de Conclusión</th>
                           
                          
                            <th>Nivel Escolar</th>
                           
                            <th>Estatus</th>
                            <th>Promedio</th>
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
            var expedientes_table = $('#escolaridad_table').DataTable({
                // autoWidth: false,
                responsive: !0,
                searching: true,
                processing: true,
                serverSide: true,
                // stateSave -  preserva el estado del datatable, cuando el usuario regresa
                //              le muestra el datatable en el mismo estado 
                dom: '<"d-flex flex-row-reverse">t<"d-flex justify-content-between" ip>r',
                ajax: {
                        url: "{!! route('estudios.list',$persona->id) !!}",
                },
                
                //scrollX: false,
                columns: [
                    {data:'id', name:'id', searchable:false},
                    {data:'nombre_de_estudio', name:'nombre_de_estudio', 
                        class:'text-capitalize nombre', 
                        width:'40%'},
                    {data:'nombre_de_institucion', name:'nombre_de_institucion', 
                        class:'text-capitalize institucion'},
                        {data:'fecha_inicio', name:'fecha_inicio',  class:"fecha_inicio"},
                       
                    {data:'fecha_conclusion', name:'fecha_conclusion',  class:"fecha_conclusion"},
                   
                    
                    
                    {data:'nivel_escolar.name', name:'nivel_escolar.name', class:'text-capitalize'},
                 
                    {data:'estatus.name', name:'estatus.name', class:'text-capitalize'},
                    {data:'promedio', name:'promedio', 
                        class:'text-capitalize promedio'},
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
            $("#escolaridad_table").DataTable().search( this.value ).draw();
        });
    </script>
@endpush
       

  


