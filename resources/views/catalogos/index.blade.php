@extends('layouts.master')

@section ('content')

    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
        <a class="btn-floating btn-lg indigo">
            <i class="fa fa-wrench"></i>
        </a>

        <ul class="list-unstyled">
            <li><a class="btn-floating btn-lg success-color-dark" 
                    href="./catalogos/create?parent_id={{$parent_id}}" >
                <i class="fa fa-plus"></i></a></li>
            <li><a id="select_catalogo" class="btn-floating brown">
                <i class="fa fa-thumb-tack"></i></a></li>            
            <li><a id="delete_catalogo" class="btn-floating btn-sm red">
                <i class="fa fa-trash"></i></a></li>
            <li><a id="edit_catalogo" class="btn-floating btn-sm warning-color-dark">
                <i class="fa fa-pencil"></i></a></li>
            <li><a id="view_catalogo" class="btn-floating btn-sm blue">
                <i class="fa fa-search"></i></a></li>
        </ul>
    </div>

    <div class="col-md-12">
        <div class="card col-12 badge badge-light">
            <div class="d-flex flex-row col-md-12">
                <div class="d-flex flex-wrap col-md-9" name="bread_crumbs">
                    @foreach($bread_crumbs as $key => $value)
                        <a class="h6 black-text row p-1 m-1" 
                            href="{{ route('catalogos.index',$value) }}"
                            rel="tooltip" title="Editar {{$key}}">
                            <i class="fa fa-edit fa-2x mt-1 teal-text"></i>
                            <span class="p-2">{{$key}}</span>
                        </a>
                    @endforeach
                </div>
                <div class="d-flex flex-row col-md-3 mt-2">
                    <span class="p-1 mt-1 h6">Buscar</span>
                    <input type="text" name="search" id="search" class="col-sm-10 form-control">
                </div>
            </div>
        </div>

        <div class="p-3">
            <table id="select_catalogos_table" class="table table-striped"
                cellspacing="0" width="100%">

                <thead class="">
                    <tr>
                        <th>
                        </th>
                        <th>Id</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($catalogos as $catalogo)
                    <tr id="row.{{$catalogo->id}}">
                        <td style="width:10px;">
                            <input type="checkbox" class="form-check-input with-gap" 
                            id="select_item_{{$catalogo->id}}" 
                            name="select_item"
                            value="{{$catalogo->id}}"
                            >
                            <label class="form-check-label" for="select_item_{{$catalogo->id}}"></label>
                        </td>
                        <td class="catalogo_id">{{$catalogo->id}}</td>
                        <td class="catalogo_nombre">{{$catalogo->name}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>
    </div>

</div>

@include ('layouts.partials.modal.confirm_deletion',['route'=>$route,
    'modal_question'=>'Esta seguro de querer eliminar el elemento?']) 

@endsection

@section('custom_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var order_items_table = $('#select_catalogos_table').DataTable({
                paging: true,
                info: true,
                ordering: true,
                searching: true,
                processing: false,
                serverSide: false,
                dom: '<"d-flex flex-row-reverse">t<"d-flex justify-content-between" ip>r'
            });

            $("#search").on('keyup', function() {
                $("#select_catalogos_table").DataTable().search( this.value ).draw();
            });

            //code to select only one checkbox (course) at a time
            $('[name="select_item"]').on('change', function() {
                $('[name="select_item"]').not(this).prop('checked', false);  
                var catalogo_id = this.value;
                if (this.checked){
                    $("#edit_catalogo").prop('href','./catalogos/'+ catalogo_id + '/edit');
                    $("#view_catalogo").prop('href','./catalogos/'+ catalogo_id);
                    $("#select_catalogo").prop('catalogo_id', catalogo_id);
                } else {
                    $("#edit_catalogo").prop('href','#');
                    $("#view_catalogo").prop('href','#');
                    $("#select_catalogo").removeProp('catalogo_id');
                }
            });

            // hack needed to fixed button work
            $('.fixed-action-btn').unbind('click');

            function getCatalogoId(){
                var row = $( "input:checked" );
                return (row.length > 0) ? row[0].value : 0 ;
            };

            $('#select_catalogo').on('click', function() {
                var catalogo_id = getCatalogoId();
                if(catalogo_id>0){
                    $("#select_catalogo").prop('href','./catalogos?parent_id=' + catalogo_id);
                    $("#select_catalogo").trigger('click');
                }                
            });            

            $('#edit_catalogo').on('click', function() {
                var catalogo_id = getCatalogoId();
                if(catalogo_id>0){
                    $("#edit_catalogo").prop('href','./catalogos/'+ catalogo_id + '/edit');
                    $("#edit_catalogo").trigger('click');
                }
            });            

            $('#view_catalogo').on('click', function() {
                var catalogo_id = getCatalogoId();
                if(catalogo_id>0){
                    $("#view_catalogo").prop('href','./catalogos/'+ catalogo_id);
                    $("#view_catalogo").trigger('click');
                }
            });

            $('#delete_catalogo').on('click', function() {
                 var catalogo_id = getCatalogoId();
                if(catalogo_id == 0){
                    alert("debe seleccionar un elemento ");
                    return true;
                }
                var row = $("#select_item_" + catalogo_id ).closest('tr');
                var catalogo_nombre = row.find('td.catalogo_nombre').text()

                //alert(catalogo_nombre);
                $("#modal-delete-title").html( 
                    '<h4>Elemento a eliminar : '+ catalogo_nombre + '</h4>'+'</span>');
                
                $('#confirm_deletion_link').on('click', function() {
                    old_url = $('#confirm_modal_deletion_buttons_form').attr('action');
                    new_url = old_url.replace('confirm_deletion_item_id',catalogo_id);
                    $('#confirm_modal_deletion_buttons_form').attr('action', new_url);
                });

                $('#confirm_deletion_link').trigger('click');
            });

        });

    </script>

@endsection

