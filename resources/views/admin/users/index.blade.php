@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card col-md-12 badge badge-light">
            <div class="d-flex flex-row mx-2 mt-2 mb-1">
                <div class="h4 pt-1">Usuarios</div>
                <div class="pt-1">
                    <a href="{{route('users.create')}}" 
                        class="text-success text-capitalize mx-2 justify-vertical" 
                        style="margin-top: -2px;" title="Agregar role">
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
                    id="users_table">
                        <thead class="">
                            <tr>
                                <th>Id</th>
                                <th>Usuario</th>
                                <th>Nombre</th>
                                <th>Paterno</th>
                                <th>Materno</th>
                                <th>Nombre</th>
                                <th>Email</th>
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
            var users_table = $('#users_table').DataTable({
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
                        url: "{!! route('list.users') !!}",
                },
                
                //scrollX: false,
                columns: [
                    {data:'id', name:'id', searchable:false, orderable:true, 
                        class:'text-uppercase', width:'10%'},
                    {data:'name', name:'name', class:'text-uppercase'},
                    {data:'nombre', name:'nombre', class:'text-uppercase', visible:false},
                    {data:'paterno', name:'paterno', class:'text-uppercase', visible:false},
                    {data:'materno', name:'materno', class:'text-uppercase', visible:false},
                    {data:'fullname', name:'fullname', class:'text-uppercase', searchable:false},
                    {data:'email', name:'email', class:'text-uppercase'},
                    {data:'acciones', name:'acciones', searchable:false, orderable:false,
                        class:'text-uppercase', width:'12%',
                        render: function(data,style,row,meta){
                             return $("<div/>").html(data).text();
                         }
                    }
                ],
                order: [ 3, "asc" ]
            });
        });

        $("#search").on('keyup', function() {
            $("#users_table").DataTable().search( this.value ).draw();
        });
    </script>
@endpush

