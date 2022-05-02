<div id="div_escolaridad_form" style="display:none;">
    <form method="POST" id="escolaridad_form" action="{{$route}}" >
        @csrf
        <input type="hidden" name="escolaridad_id" id="escolaridad_id" 
            value="{{$escolaridad->id ?? ''}}">
        <input type="hidden" name="persona_id" id="persona_id" 
            value="{{$persona->id ?? ''}}">

        <div class="form-row">

            <div class="form-group col-md-6">
              <label for="nombre_de_estudio">Nombre de estudio</label>
              <input type="text" class="form-control" id="nombre_de_estudio"  
                name="nombre_de_estudio" 
                value="{{ old('nombre_de_estudio',$escolaridad->nombre_de_estudio ?? '')}}">
            </div> 

            <div class="form-group col-md-6">
              <label for="nombre_de_institucion">Nombre de institucion</label>
              <input type="text" class="form-control" id="nombre_de_institucion"  
                name="nombre_de_institucion" 
                value="{{ old('nombre de institucion',$escolaridad->nombre_de_institucion ?? '')}}">
            </div> 
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="nivel_escolar_id">Nivel escolar</label>
                <select id="nivel_escolar_id" name="nivel_escolar_id" 
                    class="col-md-12 browser-default custom-select">
                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="estatus_id">Estatus escolar</label>
                <select id="estatus_id" name="estatus_id" 
                    class="col-md-12 browser-default custom-select">
                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="fecha_inicio">Año inicio</label>
                <input id="fecha_inicio" name="fecha_inicio" 
                    class="col-md-12 form-control" type="integer"
                    value="{{ old('fecha_inicio', $escolaridad->fecha_inicio ?? Carbon\Carbon::now()->year ) }}">
            </div>

            <div class="form-group col-md-2">
                <label for="fecha_conclusion">Año Conclusión</label>
                <input id="fecha_conclusion" name="fecha_conclusion" 
                    class="col-md-12 form-control" type="integer"
                    value="{{ old('fecha_conclusion', $escolaridad->fecha_conclusion ?? Carbon\Carbon::now()->year ) }}">
            </div>
        </div>
        <div class="pt-4 d-flex flex-row justify-content-end">
            <a id="cancel_button" class="btn btn-default">Cancelar</a>
            <a id="save_button" class="btn btn-primary">Guardar</a>
        </div>
    </form>
</div>
@push('scripts2')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#cancel_button").on('click', function(){  
                $("#div_escolaridad_table").show();
                $("#div_escolaridad_form").hide();
                $("#escolaridad_form")[0].reset();
            });
            $("#save_button").on('click', function(){  
                $("#escolaridad_form")[0].submit();
            });

            dynamicDropdown("/items/nivel_escolar/",
            {{ old('nivel_escolar_id',isset($escolaridad->nivel_escolar_id)?$escolaridad->nivel_escolar_id:0) ?? 0 }},
            'nivel_escolar_id');

            dynamicDropdown("/items/estatus_escolar/",
            {{ old('estatus_id',isset($escolaridad->estatus_id)?$escolaridad->estatus_id:0) ?? 0 }},
            'estatus_id');

        });
    </script>
@endpush