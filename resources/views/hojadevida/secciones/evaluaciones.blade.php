<hr width="100%" style="border-top:2px solid #e0e0e0;" > 
<div class="col-12" id="evaluaciones" name="evaluaciones">
                <label for="titulo" class="pt-3 pb-3">
                <h4><strong class="text-uppercase ">Evaluaciones</strong></h4>
                 
                </label>
@if($persona->evaluaciones()->exists())
              @foreach($persona->evaluaciones as $evaluacion)
              <br>
              <label for="titulo" class="pt-3 pb-3">
                    <h6>Evaluacion: {{$loop->iteration}}</h6> 
                    
                </label> 
        <div class="form-row">
                <div class="md-form col-md-3">
                    <label class="active pl-3" for="fecha_resultado">Fecha de resultado</label>

                    <input readonly disable id="fecha_resultado" name="fecha_resultado" class="form-control {{$input_color}}" type="text" 
                    value="{{$evaluacion->fecha_resultado->format('Y-m-d') }}">
                </div>
                <div class="md-form col-md-4">
                    <label class="active pl-3" for="tipo_evaluacion_id">Tipo evaluacion</label>
                    <input readonly disable class="form-control {{$input_color}}" id="tipo_evaluacion_id" type="text" 
                    name="tipo_evaluacion_id" 
                    value="{{$evaluacion->tipo_evaluacion->name ?? ''}}">
                </div>
                <div class="md-form col-md-2">
                    <label class="active pl-3" for="resultado_id">Resultado</label>
                    <input readonly disable class="form-control {{$input_color}}" id="resultado_id" type="text" 
                    name="resultado_id" 
                    value="{{$evaluacion->resultado->name ?? ''}}">
                </div>
                <div class="md-form col-md-2">
                    <label class="active pl-3" for="tiempo_de_validez">Vigencia</label>
                    <input readonly disable class="form-control {{$input_color}}" id="tiempo_de_validez" type="text" 
                    name="tiempo_de_validez" 
                    value="{{$evaluacion->tiempo_de_validez ?? ''}}">
                </div>
            </div>
         
        
               
            @endforeach  
            @else 
                    <br>
                <label for="informe" class="pt-3 pb-3">
                    <em>No existe ningun registro</em> 
                </label>
                
            @endif 
        </div>