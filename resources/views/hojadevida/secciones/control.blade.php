<hr width="100%" style="border-top:2px solid #e0e0e0;" > 
<div class="col-12" id="control" name="control">
                <label for="titulo" class="pt-3 pb-3">
                <h4><strong class="text-uppercase ">Control y confianza</strong></h4>
              
                </label>
            @if($persona->control()->exists())
              @foreach($persona->control as $evaluacion)
              <br>
              <label for="titulo" class="pt-3 pb-3">
                    <h6>Control y confianza: {{$loop->iteration}}</h6> 
                    
                </label> 
        <div class="form-row">
                <div class="md-form col-md-3">
                    <label class="active pl-3" for="fecha_resultado">Fecha de resultado</label>

                    <input readonly disable id="fecha_resultado" name="fecha_resultado" class="form-control {{$input_color}}" type="text" 
                    value="{{$evaluacion->fecha_resultado->format('Y-m-d') }}">
                </div>
                <div class="md-form col-md-4">
                    <label class="active pl-3" for="motivo_control_id">Motivo</label>
                    <input readonly disable class="form-control {{$input_color}}" id="motivo_control_id" type="text" 
                    name="motivo_control_id" 
                    value="{{$evaluacion->motivo_control->name ?? ''}}">
                </div>
                <div class="md-form col-md-2">
                    <label class="active pl-3" for="resultado_id">Resultado</label>
                    <input readonly disable class="form-control {{$input_color}}" id="resultado_id" type="text" 
                    name="resultado_id" 
                    value="{{$evaluacion->resultado->name ?? ''}}">
                </div>
                <div class="md-form col-md-2">
                    <label class="active pl-3" for="vigencia">Vigencia</label>
                    <input readonly disable class="form-control {{$input_color}}" id="vigencia" type="text" 
                    name="vigencia" 
                    value="{{$evaluacion->vigencia->format('Y-m-d') ?? ''}}">
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