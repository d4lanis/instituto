<div id="div_referencias_table" class="container pt-2">
    <div class="card col-md-12 badge badge-light">
        <div class="d-flex flex-row mx-2 mt-2 mb-1">
            <div class="h4 pt-1">Referencias</div>
            <div class="pt-1">
            <a href="#"  id="add_referencias"
                    class="text-success text-capitalize mx-2 justify-vertical" 
                    style="margin-top: -2px;" title="Ingresar estudio">
                    <i class="fa fa-plus-circle fa-2x pt-1"></i> 
                </a>
       
            </div>
            <div class="d-flex flex-row ml-auto pr-2">
                <span class="p-1 mt-1 h6">Buscar</span>
                <input type="text" name="search_referencia" id="search_referencia" class="col-sm-10 form-control">
            </div>
        </div>
    </div>
    <div class="card-block">            
        <div id="table-container" class="p-3 col-12">
            <table class="table table-striped" cellspacing="0" width="100%" 
            id="referencias_table" data-form="deleteForm">
                <thead class="">
                    <tr>
                        <th>Id</th>
                        <th>Paterno</th>
                        <th>Materno</th>
                        <th>Nombre</th>
                        <th>Sexo</th>
                        <th>Relacion</th>
                        <th>Ocupacion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@push('scripts2')
 
    <script type="text/javascript">
        $(document).ready(function(){

            $("#add_referencias").on('click', function(){  
                $("#referencias_form").show();
                $("#div_referencias_table").hide();
            });
            
            var expedientes_table = $('#referencias_table').DataTable({
                // autoWidth: false
                responsive: !0,
                searching: true,
                processing: true,
                serverSide: true,
                // stateSave -  preserva el estado del datatable, cuando el usuario regresa
                //              le muestra el datatable en el mismo estado 
                dom: '<"d-flex flex-row-reverse">t<"d-flex justify-content-between" ip>r',
                ajax: {
                        url: "{{route('list.profile.referencias',Auth::id())}}",
                },
                
                //scrollX: false,
                columns: [
                    {data:'id', name:'id', searchable:false},
                    {data:'paterno_referencia', name:'paterno_referencia',
                        class:"paterno_referencia text-capitalize"},
                    {data:'materno_referencia', name:'materno_referencia',
                        class:"materno_referencia text-capitalize"},
                    {data:'nombre_referencia', name:'nombre_referencia',
                        class:'nombre_referencia text-capitalize'},
                    
                    {data:'sexo.name', name:'sexo.name text-capitalize'},
                    {data:'parentesco.name', name:'parentesco.name', 
                        class:'text-capitalize parentesco_id'},
                    {data:'ocupacion_referencia', name:'ocupacion_referencia', 
                        class:'text-capitalize ocupacion_referencia'},
        
                    {data:'acciones', name:'acciones', searchable:false, orderable:false,
                        render: function(data,style,row,meta){
                             return $("<div/>").html(data).text();
                         }
                    }
                ],
                order: [ 1, "desc" ]
            });
        });

        $("#search_referencia").on('keyup', function() {
            $("#referencias_table").DataTable().search( this.value ).draw();
        });
    </script>
@endpush