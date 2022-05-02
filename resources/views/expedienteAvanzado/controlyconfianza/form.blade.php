@extends('expedienteAvanzado.edit')
@section('control')

<form method="POST" id="control_form" action="{{$route}}">
    @csrf
    <input type="hidden" name="control_id" id="evaluacion_id" value="{{$control->id ?? ''}}">
    <input type="hidden" name="persona_id" id="persona_id" value="{{$persona->id ?? ''}}">
    <input type="hidden" id="tipo_control_confianza"
        value="{{ old('tipo_control_confianza_id', $control->tipo_control_confianza_id ?? 0) }}">
    <input type="hidden" id="motivo_control" value="{{ old('motivo_control_id', $control->motivo_control_id ?? 0) }}">
    <input type="hidden" id="resultado" value="{{ old('resultado_id', $control->resultado_id ?? 0) }}">






    <div class="form-row">


        <div class="form-group col-md-6 ">
            <label for="motivo_control_id">Motivo</label>
            <select id="motivo_control_id" name="motivo_control_id" class="col-md-12 browser-default custom-select">
            </select>
        </div>

        <div class="form-group col-md-6">
            <label for="tipo_control_confianza_id">Tipo control y confianza</label>
            <select id="tipo_control_confianza_id" name="tipo_control_confianza_id"
                class="col-md-12 browser-default custom-select">
            </select>
        </div>


    </div>

    <div class="form-row general" style="{{$fechas_general ?? ''}}" id="general">
        <div class="form-group col-md-4">
            <label for="fecha_prueba_1">Fecha prueba 1</label>
            <input id="fecha_prueba_1" name="fecha_prueba_1" class="col-md-12 col-form" type="date" value="{{old('fecha_prueba_1', isset($control->fecha_prueba_1) ?
											$control->fecha_prueba_1->format('Y-m-d') : '')}}">


        </div>
        <div class="form-group col-md-4">
            <label for="fecha_prueba_2">Fecha prueba 2</label>
            <input id="fecha_prueba_2" name="fecha_prueba_2" class="col-md-12 col-form" type="date" value="{{old('fecha_prueba_2', isset($control->fecha_prueba_2) ?
											$control->fecha_prueba_2->format('Y-m-d') : '')}}">


        </div>
        <div class="form-group col-md-4">
            <label for="fecha_prueba_3">Fecha prueba 3</label>
            <input id="fecha_prueba_3" name="fecha_prueba_3" class="col-md-12 col-form" type="date" value="{{old('fecha_prueba_3', isset($control->fecha_prueba_3) ?
											$control->fecha_prueba_3->format('Y-m-d') : '')}}">


        </div>
    </div>

    <div class="form-row arma" style="{{$fechas_arma ?? ''}}" id="arma">
        <div class="form-group col-md-4">
            <label for="fecha_prueba_arma">Fecha prueba</label>
            <input id="fecha_prueba_arma" name="fecha_prueba_arma" class="col-md-12 col-form" type="date" value="{{old('fecha_prueba_arma', isset($control->fecha_prueba_arma) ?
											        $control->fecha_prueba_arma->format('Y-m-d') : '')}}">


        </div>

    </div>


    <div class="form-row">

        <div class="form-group col-md-6">
            <label for="duracion">Duracion</label>
            <input type="text" class="form-control" id="duracion" name="duracion" value="{{$control->duracion ?? ''}}">
        </div>

        <div class="form-group col-md-6">
            <label for="numero_oficio">Numero oficio</label>
            <input type="text" class="form-control" id="numero_oficio" name="numero_oficio"
                value="{{$control->numero_oficio ?? ''}}">
        </div>
    </div>







    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="fecha_resultado">Fecha resultado</label>
            <input id="fecha_resultado" name="fecha_resultado" class="col-md-12 col-form" type="date"
                value="{{ old('fecha_resultado', $fecha_resultado ?? '' ) }}">


        </div>

        <div class="form-group col-md-4">
            <label for="resultado_id">Resultado</label>
            <select id="resultado_id" name="resultado_id" class="col-md-12 browser-default custom-select">
            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="vigencia">Vigencia</label>
            <input id="vigencia" name="vigencia" class="col-md-12 col-form" type="date"
                value="{{ old('vigencia', $vigencia ?? '' ) }}">


        </div>
    </div>






    <div class="form-row">

        <div class="form-group col-md-8">
            <label for="observaciones">Observaciones</label>
            <input type="text" class="form-control" id="observaciones" name="observaciones"
                value="{{$control->observaciones ?? ''}}">
        </div>
    </div>



    <div class="pt-4 d-flex flex-row">

        <div class="ml-auto">
            <a href="{{route('evaluaciones',$persona->id)}}" class="nav-link">
                <span class="badge badge-info text-white p-2 z-depth-2">
                    <i class="fa fa-undo fa-lg" aria-hidden="true"></i>
                </span>
            </a>
            <button class="btn btn-primary">Guardar</button>
        </div>
    </div>

</form>
@endsection

@push('scripts2')
<script type="text/javascript">
    $(document).ready(function() {



            dynamicDropdown("/items/{{ App\Models\Catalogo::CONTROL_CONFIANZA_RESULTADO }}", 
            	$("#resultado").val(), 'resultado_id');
                dynamicDropdown("/items/{{ App\Models\Catalogo::TIPO_CONTROL_CONFIANZA }}", 
            	                                        $("#tipo_control_confianza").val(), 'tipo_control_confianza_id');
                     dynamicDropdown("/items/{{ App\Models\Catalogo::MOTIVO_CONTROL_CONFIANZA }}", 
            	$("#motivo_control").val(), 'motivo_control_id');
                
          
                 $('select[name="tipo_control_confianza_id"]').change(function(e){

                var optionId = $('select[name="tipo_control_confianza_id"] option:selected').text();

                if(optionId == "GENERAL"){
                    document.getElementById("general").style.display = "flex";
                    document.getElementById("arma").style.display = "none";
                }else
                {
                    document.getElementById("arma").style.display = "flex";
                    document.getElementById("general").style.display = "none";

                }
                                console.log(optionId);
                            });
		
               
          
        });
</script>

@endpush