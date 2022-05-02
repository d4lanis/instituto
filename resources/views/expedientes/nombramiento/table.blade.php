@extends('expedientes.edit') 
@section('nombramiento_table')
    <div class="container pt-2">
        <div class="card col-md-12 badge badge-light">
            <div class="d-flex flex-row mx-2 mt-2 mb-1">
                <div class="h4 pt-1">Nombramientos</div>
                <div class="pt-1">
                <a href="{{route('nombramientos.create',$persona->id)}}" 
                    class="text-success text-capitalize mx-2 justify-vertical" 
                    style="margin-top: -2px;" title="Ingresar estudio">
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
                id="nombramiento_table" data-form="deleteForm">
                    <thead class="">
                        <tr>
                            <th>Id</th>
                            <th>Nombre del cargo o grado</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha de inicio</th>
                            <th>Area de adscripcion</th>
                            <th>Calificacion de formacion inicial</th>
                            <th>Nombre de documento oficial</th>
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
            var expedientes_table = $('#nombramiento_table').DataTable({
                // autoWidth: false,
                responsive: !0,
                searching: true,
                processing: true,
                serverSide: true,
                // stateSave -  preserva el estado del datatable, cuando el usuario regresa
                //              le muestra el datatable en el mismo estado 
                dom: '<"d-flex flex-row-reverse">t<"d-flex justify-content-between" ip>r',
                ajax: {
                        url: "{!! route('nombramientos.list',$persona->id) !!}",
                },
                
                //scrollX: false,
                columns: [
                    {data:'id', name:'id', searchable:false},
                    {data:'nombre_cargo_grado', name:'nombre_cargo_grado', 
                        class:'text-capitalize nombre'},
                    {data:'fecha_inicio', name:'fecha_inicio', visible:false, class:'fecha_inicio'},
                    {data:'fecha_inicio_str', name:'fecha_inicio_str',  class:"fecha_inicio_str"},

                    {data:'area_adscripcion', name:'area_adscripcion', 
                        class:'text-capitalize area'},

                    {data:'promedio', name:'promedio', 
                        class:'text-capitalize promedio'},

                    {data:'nombre_documento_certifica', name:'nombre_documento_certifica', 
                        class:'text-capitalize nombre_documento_certifica'},

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
            $("#nombramiento_table").DataTable().search( this.value ).draw();
        });
    </script>
@endpush
       

  


