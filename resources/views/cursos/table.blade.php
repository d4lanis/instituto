@extends('layouts.master')

@section('content')
<div class="container-fluid pt-2">
    <div class="card col-md-12 badge badge-light">
        <div class="d-flex flex-row mx-2 mt-2 mb-1">
            <div class="h4 pt-1">Curso</div>
            <div class="pt-1">
                <a href="{{route('cursos.create')}}" 
                    class="text-success text-capitalize mx-2 justify-vertical" 
                    style="margin-top: -2px;" title="Ingresar paciente">
                    <i class="fa fa-plus-circle fa-2x pt-1"></i> 
                </a>
            </div>
            <div class="d-flex flex-row ml-auto pr-2">
                <span class="p-1 mt-1 h6">Buscar</span>
                <input type="text" name="search" id="search" class="col-sm-10 form-control">
            </div>
            <div class="back pl-1">
            <a href="{{route('home')}}" class="p-2">
		                        <span class="badge badge-primary text-white p-2 z-depth-2">
		                            <i class="fa fa-undo fa-2x" aria-hidden="true"></i>
		                        </span>
		                    </a>
                            </div>
        </div>
    </div>
    <div class="card-block">            
        <div id="table-container" class="p-3 col-12">
            <table class="table table-striped" cellspacing="0" width="100%" 
            id="cursos_table" data-form="deleteForm">
                <thead class="">
                    <tr>

                    <th>ID</th>
                    <th width="10%">Oficio Numero</th>
                        <th>Plan de estudios</th>
                       
                        
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Termino</th>
                        <th>Fecha Termino</th>
                       
                        <th>Oficio Fecha</th>
                        <th>Oficio Fecha</th>
                        <th>Kardex Fecha</th>
                        <th>Kardex Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts2')
    @include('layouts.partials.modal.custom_script_delete')
    <script type="text/javascript">
        $(document).ready(function(){
            var expedientes_table = $('#cursos_table').DataTable({
                // autoWidth: false,
                responsive: !0,
                select: !0,
                searching: true,
                processing: true,
                serverSide: true,
                // stateSave -  preserva el estado del datatable, cuando el usuario regresa
                //              le muestra el datatable en el mismo estado 
                dom: '<"d-flex flex-row-reverse">t<"d-flex justify-content-between" ip>r',
                ajax: {
                        url: "{!! route('cursos.list') !!}",
                },
                
                //scrollX: false,
                columns: [
                    {data:'id', name:'id', visible:false,  class:'text-capitalize'},
                    {data:'oficio_numero', name:'oficio_numero', class:'text-capitalize'},
                    {data:'planes.nombre', name:'planes.nombre',  class:'text-capitalize'},
                    
                    {data:'nombre', name:'nombre', class:'text-capitalize'},
                    {data:'descripcion', name:'descripcion', class:'text-capitalize'},
                    {data:'fecha_inicio', name:'fecha_inicio', visible:false, class:'text-capitalize'},
                    {data:'fecha_inicio_str', name:'fecha_inicio_str', class:'text-capitalize'},
                    {data:'fecha_termino', name:'fecha_termino', visible:false,  class:'text-capitalize'},
                    {data:'fecha_termino_str', name:'fecha_termino_str', class:'text-capitalize'},
                  
                    
                    {data:'oficio_fecha', name:'oficio_fecha', visible:false,  class:'text-capitalize'},
                    {data:'oficio_fecha_str', name:'oficio_fecha_str', visible:false, class:'text-capitalize'},
                    {data:'kardex_fecha', name:'kardex_fecha', visible:false,  class:'text-capitalize'},
                    {data:'kardex_fecha_str', name:'kardex_fecha_str', visible:false, class:'text-capitalize'},
                    
                    {data: 'acciones', name:'acciones', searchable:false, orderable:false,
                        width:'18%',
                        render: function(data,style,row,meta){
                             return $("<div/>").html(data).text();
                         }
                    }
                ],
                order: [ 1, "desc" ]
            });
        });

        $("#search").on('keyup', function() {
            $("#cursos_table").DataTable().search( this.value ).draw();
        });
    </script>
@endpush