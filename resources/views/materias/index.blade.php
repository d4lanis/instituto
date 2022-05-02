@extends('layouts.master')

@section('content')
<div class="container">
    <div class="card col-md-12 badge badge-light">
        <div class="d-flex flex-row mx-2 mt-2 mb-1">
            <div class="h4 pt-1">Agregar Materia </div>
            <div class="pt-1">
                <a href="{{$route}}" class="text-success text-capitalize mx-2 justify-vertical" 
                    style="margin-top: -2px;" title="Agregar materia">
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
            id="materia_table">
                <thead class="">
                    <tr>
                        <th>Id</th>
                        <th>Categoría</th>
                        <th>Tipo</th>
                        <th>Nombre</th>
                        <th>Lugares</th>
                        <th>Duración</th>
                        <th>Calificacion mínima</th>
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
            var categorias_table = $('#materia_table').DataTable({
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
                        url: "{!! route('list.materias') !!}",
                },
                
                //scrollX: false,
                columns: [
                    {data:'id', name:'id', orderable:true, searchable:false},
                    {data:'categoria_materia.name', name:'categoria_materia.name', orderable:true},
                    {data:'tipo_materia.name', name:'tipo_materia.name', orderable:true},
                    {data:'nombre', name:'nombre', class:'text-capitalize'},
                    {data:'lugares', name:'lugares', class:'text-capitalize'},
                    {data:'duracion', name:'duracion', class:'text-capitalize'},
                    {data:'calificacion_minima', name:'calificacion_minima', class:'text-capitalize'},
                    {data: 'acciones', name:'acciones', searchable:false, orderable:false,
                        width:'10%',
                        render: function(data,style,row,meta){
                             return $("<div/>").html(data).text();
                         }
                    }
                ],
                order: [ 1, "desc" ]
            });
        });

        $("#search").on('keyup', function() {
            $("#materia_table").DataTable().search( this.value ).draw();
        });
    </script>
@endpush