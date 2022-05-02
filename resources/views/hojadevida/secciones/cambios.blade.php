<hr width="100%" style="border-top:2px solid #e0e0e0;" > 
<div class="col-12" id="cambios" name="cambios">
                <label for="titulo" class="pt-3 pb-3">
                <h4><strong class="text-uppercase ">Cambios</strong></h4>
             
                </label>
@if($persona->cambios()->exists())
              @foreach($persona->cambios as $cambio)
              <br>
              <label for="titulo" class="pt-3 pb-3">
                    <h6>Cambio: {{$loop->iteration}}</h6> 
                    
                </label> 
        <div class="form-row">
                <div class="md-form col-md-3">
                    <label class="active pl-3" for="fecha_cambio">Fecha de cambio</label>

                    <input readonly disable id="fecha_cambio" name="fecha_cambio" class="form-control {{$input_color}}" type="text" 
                    value="{{$cambio->fecha_cambio->format('Y-m-d') }}">
                </div>
                <div class="md-form col-md-4">
                    <label class="active pl-3" for="motivo_cambio_id">Motivo cambio</label>
                    <input readonly disable class="form-control {{$input_color}}" id="motivo_cambio_id" type="text" 
                    name="motivo_cambio_id" 
                    value="{{$cambio->motivo_cambio->name ?? ''}}">
                </div>
                <div class="md-form col-md-2">
                    <label class="active pl-3" for="puesto_id">Puesto </label>
                    <input readonly disable class="form-control {{$input_color}}" id="puesto_id" type="text" 
                    name="puesto_id" 
                    value="{{$cambio->puesto->name ?? ''}}">
                </div>
                <div class="md-form col-md-2">
                    <label class="active pl-3" for="puesto_nuevo_id">Puesto Nuevo</label>
                    <input readonly disable class="form-control {{$input_color}}" id="puesto_nuevo_id" type="text" 
                    name="puesto_nuevo_id" 
                    value="{{$cambio->puesto_nuevo->name ?? ''}}">
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