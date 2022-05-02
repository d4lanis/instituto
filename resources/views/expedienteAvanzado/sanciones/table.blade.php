@extends('expedienteAvanzado.edit') 
@section('sanciones_table')
    <div class="container pt-2">
        <div class="card col-md-12 badge badge-light">
            <div class="d-flex flex-row mx-2 mt-2 mb-1">
                <div class="h4 pt-1">Sanciones</div>
                <div class="pt-1">
                <a href="{{route('sanciones.create',$persona->id)}}" 
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
                id="sanciones_table" data-form="deleteForm">
                    <thead class="">
                        <tr>
                            <th>Id</th>
                        
                            <th>Origen Queja </th>
                         
                            <th>Tipo Queja </th>
                            <th>Folio interno</th>
                            <th>Asunto</th>
                          
                            <th>Tipo Sancion </th>
                           
                            <th>Estado Sancion </th>
                            <th>FI </th>
                            <th>Fecha Inicio </th>
                            <th>FT </th>
                            <th>Fecha Termino </th>
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
            var expedientes_table = $('#sanciones_table').DataTable({
                // autoWidth: false,
                responsive: !0,
                searching: true,
                processing: true,
                serverSide: true,
                // stateSave -  preserva el estado del datatable, cuando el usuario regresa
                //              le muestra el datatable en el mismo estado 
                dom: '<"d-flex flex-row-reverse">t<"d-flex justify-content-between" ip>r',
                ajax: {
                        url: "{!! route('sanciones.list',$persona->id) !!}",
                },
                
                //scrollX: false,
                columns: [
                    {data:'id', name:'id', searchable:false},
                 
                    {data:'origen_queja_id', name:'origen_queja_id', class:'text-capitalize'},
             
                    {data:'tipo_queja_id', name:'tipo_queja_id', class:'text-capitalize'},
                    {data:'folio_interno', name:'folio_interno',
                        class:"folio_interno text-capitalize"},
                        {data:'asunto', name:'asunto',
                        class:"asunto text-capitalize"},
        
                    {data:'tipo_sancion.name', name:'tipo_sancion.name', class:'text-capitalize'},
           
                    {data:'estado_sancion.name', name:'estado_sancion.name', class:'text-capitalize'},    
                    {data:'fecha_inicio', name:'fecha_inicio', visible:false, class:"fecha_inicio"},
                    {data:'fecha_inicio_str', name:'fecha_inicio_str',  class:"fecha_inicio_str" },
                    {data:'fecha_termino', name:'fecha_termino', visible:false, class:"fecha_termino"},
                    {data:'fecha_termino_str', name:'fecha_termino_str',  class:"fecha_termino_str"},
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
            $("#sanciones_table").DataTable().search( this.value ).draw();
        });
    </script>
@endpush
       

  


