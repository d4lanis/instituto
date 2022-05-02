
@extends('expedienteAvanzado.edit') 
@section('merito_table')

<div class="container pt-2">
        <div class="card col-md-12 badge badge-light">
            <div class="d-flex flex-row mx-2 mt-2 mb-1">
                <div class="h4 pt-1">Meritos</div>
                <div class="pt-1">
                <a href="{{route('meritos.create',$persona->id)}}" 
                    class="text-success text-capitalize mx-2 justify-vertical" 
                    style="margin-top: -2px;" title="Ingresar merito">
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
                id="meritos_table" data-form="deleteForm">
                    <thead class="">
                        <tr>
                            <th>Id</th>
                            <th>Tipo merito Id</th>
                            <th>Tipo merito </th>
                            <th>Merito por Id</th>
                            <th>Merito por </th>
                            <th>Folio interno</th>
                            <th>Fecha Reconocimiento</th>
                            <th>Fecha Reconocimiento</th>
                            <th>Notas</th>
                          
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
            var expedientes_table = $('#meritos_table').DataTable({
                // autoWidth: false,
                responsive: !0,
                searching: true,
                processing: true,
                serverSide: true,
                // stateSave -  preserva el estado del datatable, cuando el usuario regresa
                //              le muestra el datatable en el mismo estado 
                dom: '<"d-flex flex-row-reverse">t<"d-flex justify-content-between" ip>r',
                ajax: {
                        url: "{!! route('meritos.list',$persona->id) !!}",
                },
                
                //scrollX: false,
                columns: [
                    {data:'id', name:'id', searchable:false},
                    {data:'merito_por.id', name:'merito_por.id', visible:false, class:'merito_por_id'},
                    {data:'merito_por.name', name:'merito_por.name', class:'text-capitalize'},
                    {data:'tipo_merito.id', name:'tipo_merito.id', visible:false, class:'tipo_merito_id'},
                    {data:'tipo_merito.name', name:'tipo_merito.name', class:'text-capitalize'},
                    {data:'folio_interno', name:'folio_interno',
                        class:"folio_interno text-capitalize"},
                    {data:'fecha_reconocimiento', name:'fecha_reconocimiento', visible:false,  class:"fecha_reconocimiento"},
                    {data:'fecha_reconocimiento_str', name:'fecha_reconocimiento_str',  class:"fecha_reconocimiento_str"},
                  
                    {data:'notas', name:'notas',
                        class:"notas text-capitalize"},
                  
                 
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
            $("#meritos_table").DataTable().search( this.value ).draw();
        });
    </script>
@endpush