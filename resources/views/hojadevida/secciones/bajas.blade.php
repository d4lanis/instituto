<hr width="100%" style="border-top:2px solid #e0e0e0;" > 
<div class="col-12" id="bajas" name="bajas">
                <label for="titulo" class="pt-3 pb-3">
                <h4><strong class="text-uppercase ">Baja o separacion</strong></h4>
                   
                </label>
@if($persona->bajas()->exists())
              @foreach($persona->bajas as $baja)
              <br>
              <label for="titulo" class="pt-3 pb-3">
                    <h6>Baja o separacion: {{$loop->iteration}}</h6> 
                    
                </label> 
        <div class="form-row">
                <div class="md-form col-md-3">
                    <label class="active pl-3" for="fecha_baja">Fecha de baja</label>

                    <input readonly disable id="fecha_baja" name="fecha_baja" class="form-control {{$input_color}}" type="text" 
                    value="{{$baja->fecha_baja->format('Y-m-d') }}">
                </div>
               
                <div class="md-form col-md-2">
                    <label class="active pl-3" for="tipo_baja_id">Tipo baja </label>
                    <input readonly disable class="form-control {{$input_color}}" id="tipo_baja_id" type="text" 
                    name="tipo_baja_id" 
                    value="{{$baja->tipo_baja->name ?? ''}}">
                </div>

                <div class="md-form col-md-4">
                    <label class="active pl-3" for="motivo_baja_id">Motivo baja</label>
                    <input readonly disable class="form-control {{$input_color}}" id="motivo_baja_id" type="text" 
                    name="motivo_baja_id" 
                    value="{{$baja->motivo_baja->name ?? ''}}">
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