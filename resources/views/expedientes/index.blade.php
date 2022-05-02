@extends('layouts.master')

@section('content')
<div class="container pt-2">
    <div class="card col-md-12 badge badge-light">
        <div class="d-flex flex-row mx-2 mt-2 mb-1">
            <div class="h4 pt-1">Expedientes</div>
            <div class="pt-1">
                <a href="{{route('personas.create')}}" 
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
            id="expediente_table" data-form="deleteForm">
                <thead class="">
                    <tr>
                        <th>Id</th>
                        <th>Ingreso</th>
                        <th>Ingreso</th>
                        <th>Nombre</th>
                        <th>Paterno</th>
                        <th>Materno</th>
                        <th>Nombre</th>
                        <th>Sexo</th>
                        <th>Edad</th>
                      
                        <th>Categoría Puesto</th>
                        <th>Cargo Puesto</th>
                       
                        <th>RFC</th>
                        <th>CURP</th>
                        <th>CUIP</th>
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
            var expedientes_table = $('#expediente_table').DataTable({
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
                        url: "{!! route('personas.list') !!}",
                },
                
                //scrollX: false,
                columns: [
                    {data:'id', name:'id', searchable:false, orderable:true, width:'5%'},
                    {data:'fecha_ingreso', name:'fecha_ingreso', visible:false},
                    {data:'fecha_ingreso_str', name:'fecha_ingreso_str', searchable:false, width:'15%'},
                    {data:'nombre', name:'nombre', visible:false},
                    {data:'paterno', name:'paterno', visible:false},
                    {data:'materno', name:'materno', visible:false},
                    {data:'fullname', name:'fullname', class:'text-capitalize', searchable:false, width:'25%'},
                    {data:'sexo.name', name:'sexo.name', class:'text-capitalize'},
                    {data:'edad', name:'edad'},
                   
                    {data:'categoria_puestos.name', name:'categoria_puestos.name', class:'text-capitalize'},
                    {data:'cargo_puesto.name', name:'cargo_puesto.name', class:'text-capitalize'},
             
                    {data:'rfc', name:'rfc', visible:false ,class:'text-uppercase'},
                    {data:'curp', name:'curp', class:'text-uppercase', width:'15%'},
                    {data:'cuip', name:'cuip', visible:false, class:'text-uppercase'},
                    {data: 'acciones', name:'acciones', searchable:false, orderable:false,
                        width:'20%',
                        render: function(data,style,row,meta){
                             return $("<div/>").html(data).text();
                         }
                    }
                ],
                order: [ 1, "desc" ]
            });
        });

        $("#search").on('keyup', function() {
            $("#expediente_table").DataTable().search( this.value ).draw();
        });
    </script>
@endpush