<div id="div_escolaridad_table" class="card-block">       
    <div class="d-flex flex-row mx-2 mt-2 mb-1">
        <div class="pt-1">
            <a id="add_escolaridad" href="#" class="mx-2 justify-vertical" >
                <span class="h5 black-text">Escolaridad</span>
                <i class="fa fa-plus-circle fa-1x text-success"></i> 
            </a>
        </div>
        <div class="d-flex flex-row ml-auto pr-2">
            <span class="p-1 mt-1 h6">Buscar</span>
            <input type="text" name="search" id="search" class="col-sm-10 form-control">
        </div>
    </div>    
    <div id="table-container" class="p-3 col-12">        
        <table class="table table-striped" cellspacing="0" width="100%" 
        id="escolaridad_table">
            <thead class="">
                <tr>
                    <th>Id</th>
                    <th>Estudios</th>
                    <th>Institución</th>
                    <th>Grado Escolar</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@push('scripts2')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#add_escolaridad").on('click', function(){  
                $("#div_escolaridad_form").show();
                $("#div_escolaridad_table").hide();
            });

            var escolaridad_table = $('#escolaridad_table').DataTable({
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
                        url: "{{route('list.profile.escolaridad',Auth::id())}}",
                },
                
                //scrollX: false,
                columns: [
                    {data:'id', name:'id', orderable:true, searchable:false},
                    {data:'nombre_de_estudio', name:'nombre_de_estudio', 
                        class:'text-capitalize'},
                    {data:'nombre_de_institucion', name:'nombre_de_institucion', class:'text-capitalize'},
                    {data:'nivel_escolar.name', name:'nivel_escolar.name'},
                    {data:'estatus.name', name:'estatus.name'},
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
            $("#escolaridad_table").DataTable().search( this.value ).draw();
        });
    </script>
@endpush