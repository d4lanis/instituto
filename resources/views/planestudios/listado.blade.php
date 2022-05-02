@extends('layouts.master')

@section('main-content')

<div class="row col-12 mt-2">
    <div class="col-2">        

    </div>
    <div class="col-10">                     
        <div class="row">
        <input type="hidden" name="plan_id" id="plan_id" value="{{$planEstudio->id ?? ''}}">
        
            <div class="col-5 col">
                <div class="col-12 teal mx-2 p-1 z-depth-2 rounded white-text">
                    <div class="row px-3 justify-content-between">
                        <div class="pt-2 pl-2 h5">Materias Asignadas</div>
                        <div class="d-flex flex-row">
                            <a href="#" id="move_left_to_right_specifics" 
                                class="text-decoration-none px-2 pt-2">
                                    <i class="fa fa-step-forward white-text"></i>
                            </a>
                          
                        </div>
                    </div>
                </div>   
                <div id="materias_asignada" class="left"></div>
            </div>

            <div class="col-5 col">
                <div class="col-12 teal mx-2 p-1 z-depth-2 rounded white-text">
                    <div class="row px-3 justify-content-between">
                        <div class="pt-2 pl-2 h5">Materias Disponibles</div>
                        <div class="d-flex flex-row">
                            <a href="#" id="move_right_to_left_specifics" 
                                class="text-decoration-none px-2 pt-2">
                                    <i class="fa fa-step-backward white-text"></i>
                            </a>
                          
                        </div>
                    </div>
                </div>   
              
                <div id="materias_disponibles" class="right"></div>
             
            </div>
            <div class="d-flex flex-row p-2 ">
                <div class="ml-auto">
                    

                    <a href="{!! route('planEstudios.index') !!}" 
                        class="badge badge-info text-white p-2 z-depth-2">
                    <i class="fa fa-undo fa-lg fa-2x" aria-hidden="true"></i>
                </a>
                    <a href="#" class="p-2" id="save_plan">
                        <span class="badge badge-warning text-white p-2 z-depth-2">
                            <i class="fa fa-save fa-lg fa-2x" aria-hidden="true"></i>
                        </span>
                    </a>
                </div>
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
            dynamicCheckboxes(
                "{{route('planestudio.materias.asignadas',$planEstudio->id)}}",
                0, 'materias_asignada','checkbox');

            dynamicCheckboxes(
                "{{route('planestudio.materias.disponibles',$planEstudio->id)}}",
                0, 'materias_disponibles','checkbox');
           

       

            $("#move_left_to_right_specifics").click( function() {
                $('input[type=checkbox]:checked').each(function () {
                    var item = $(this);
                    move_checkbox(item, 'materias_asignada', 'materias_disponibles');
                });
            });
        
            $("#move_right_to_left_specifics").click( function() {
                $('input[type=checkbox]:checked').each(function () {
                    var item = $(this);
                    move_checkbox(item, 'materias_disponibles', 'materias_asignada');
                });
            });
           
        });

        $("#save_plan").click( function() {
            var materias_asignadas = [];
            $('div.left input[type=checkbox]').each(function () {
                    materias_asignadas.push( $(this).val() );
            });
            if (materias_asignadas.length == 0) return false;
            //alert("items" + materias_asignadas.join());
            let data = {
                materias_asignadas : materias_asignadas.join()
            }
            let url = "{{route('planestudiomaterias.store',$planEstudio->id)}}";
            var result = guardar_expediente(url, data);

            window.location.href = "{{route('planEstudios.index')}}";
        });
        
    </script>
@endpush