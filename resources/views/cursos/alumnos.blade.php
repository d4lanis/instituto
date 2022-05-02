@extends('layouts.master')

@section('main-content')

<div class="row col-12 mt-3 mb-3 ">
    <div class="col-12">
        <div class="row">

            <div class="col-8 offset-2">
                <div class="col-12 mdb-color lighten-4 mx-2 p-1 z-depth-2 rounded d-flex ">
                    <div class="mr-auto d-flex flex-row p-2">
                        <h4><span> Curso : {{$curso->nombre}}</span></h4>
                    </div>

                    <div class="">
                        <div class="ml-auto d-flex flex-row p-2">

                            @if($validacion == 0)
                            <a href="#" id="save_plan">
                                <h4>
                                    <span class="badge text-light bg-dark badge-pill"><i class="fa fa-save "></i>
                                        Guardar</span>
                                </h4>
                            </a>





                            <a href="{{route('cerrar_carga_alumnos',$curso->id)}}" class="pl-2" id="save_plan2">
                                <h4>
                                    <span class="badge badge-danger badge-pill"><i class="fa fa-lock "></i> Cerrar
                                        seleccion</span>
                                </h4>
                            </a>
                            @endif

                            </a>
                            <a href="{!! route('cursos.index') !!}" class="pl-2">
                                <h4>
                                    <span class="badge badge-info badge-pill"><i class="fa fa-undo "></i> </span>
                                </h4>
                            </a>

                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>

<div class="row col-12 mt-3 mb-3 ">
    <input type="hidden" id="categoria_puestos" value="{{ old('categoria_puestos_id' ?? 0) }}">
    <div class="col-12">
        <div class="row">

            <div class="col-8 offset-2">
                <div class="col-12 flex-row-reverse d-flex ">
                    <div class="row ">
                        <label class=" col-form-label text-md-right col-4 ">Departamento</label>
                        <select id="categoria_puestos_id" name="categoria_puestos_id"
                            class=" col-8 browser-default custom-select">
                        </select>
                    </div>
                </div>

                <div class="">

                </div>

            </div>
        </div>


    </div>
</div>
</div>

<div class="row col-12 mt-2">

    <div class="col-12">
        <div class="row">
            <div class="col-4 offset-2">
                <div class="col-12 teal mx-2 p-1 z-depth-2 rounded white-text">
                    <div class="row px-3 justify-content-between">
                        <div class="pt-2 pl-2 h5">Alumnos Asignados</div>
                        @if($validacion == 0 )
                        <div class="d-flex flex-row">

                            <a href="#" id="move_left_to_right_specifics" class="text-decoration-none px-2 pt-2">
                                <i class="fa fa-step-forward white-text"></i>
                            </a>

                        </div>
                        @endif
                    </div>
                </div>
                <div id="alumno_asignado" class="left"></div>
            </div>

            <div class="col-4 ">
                <div class="col-12 teal mx-2 p-1 z-depth-2 rounded white-text">

                    <div class="row px-3 justify-content-between">
                        @if($validacion == 0)
                        <div class="d-flex flex-row">

                            <a href="#" id="move_right_to_left_specifics" class="text-decoration-none px-2 pt-2">
                                <i class="fa fa-step-backward white-text"></i>
                            </a>

                        </div>
                        @endif
                        <div class="pt-2 pl-2 h5">Alumnos Disponibles</div>

                    </div>

                </div>

                <div id="alumnos_disponibles" class="right"></div>

            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts2')
<script type="text/javascript">
    function move_checkbox(item, from, to){
            item.prop("checked", false);
            var checkbox_item = item.parent();
            var checkbox_cloned = checkbox_item.clone()[0];//.prop('id', 'klon'+num )
            checkbox_item.remove();
            //alert(contenedor_derecho_id);
            document.getElementById(to).appendChild(checkbox_cloned);
        }

        $(document).ready(function() {
            dynamicDropdown("/items/{{ App\Models\Catalogo::CATEGORIA_PUESTOS }}", 
            	$("#categoria_puestos").val(), 'categoria_puestos_id');

            dynamicCheckboxes(
                "{{route('cursos.alumnos.asignados',$curso->id)}}",
                0, 'alumno_asignado','checkbox');

            dynamicCheckboxes(
                "{{route('cursos.alumnos.disponibles',$curso->id)}}",
                0, 'alumnos_disponibles','checkbox');
       

            $("#move_left_to_right_specifics").click( function() {
                $('input[type=checkbox]:checked').each(function () {
                    var item = $(this);
                    move_checkbox(item, 'alumno_asignado', 'alumnos_disponibles');
                });
            });
        
            $("#move_right_to_left_specifics").click( function() {
                $('input[type=checkbox]:checked').each(function () {
                    var item = $(this);
                    move_checkbox(item, 'alumnos_disponibles', 'alumno_asignado');
                });
            });
           
        });

        $("#save_plan").click( function() {
            var alumnos_asignados = [];
            $('div.left input[type=checkbox]').each(function () {
                    alumnos_asignados.push( $(this).val() );
            });
            if (alumnos_asignados.length == 0) return false;
            //alert("items" + alumnos_asignados.join());
            let data = {
                alumnos_asignados : alumnos_asignados.join()
            }
            let url = "{{ $route }}";
            var result = guardar_expediente(url, data);

        window.location.href = "{{route('alumnos_asignacion',$curso->id)}}";
        });


      

        $('select[name="categoria_puestos_id"]').change(function(e){
            
            $('input[type=checkbox]').each(function () {
                var parent = $(this).parent();
                parent.show();
            });

            var optionId = $('select[name="categoria_puestos_id"] option:selected').val();
            if (optionId > 0){
                $('input[type=checkbox]').each(function () {
                    var parent = $(this).parent();
                    parent.hide();
                });
                $('input.'+optionId+'[type=checkbox]').each(function () {
                    var parent = $(this).parent();
                    parent.show();
                });
            }
            
                
        });
        
</script>
@endpush