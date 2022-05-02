<hr width="100%" style="border-top:2px solid #e0e0e0;" > 
<div class="col-12" id="sanciones" name="sanciones">
                <label for="titulo" class="pt-3 pb-3">
                <h4><strong class="text-uppercase ">Sanciones</strong></h4>
             
                </label>
               @if($persona->sanciones()->exists())
              @foreach($persona->sanciones as $sancion)
              <br>
              <label for="titulo" class="pt-3 pb-3">
                    <h6>Sancion {{$loop->iteration}}</h6> 
                </label> 
        <div class="form-row">
                <div class="md-form col-md-3">
                    <label class="active pl-3" for="fecha_inicio">Fecha de inicio</label>

                    <input readonly disable id="fecha_inicio" name="fecha_inicio" class="form-control {{$input_color}}" type="text" 
                    value="{{$sancion->fecha_inicio->format('Y-m-d') }}">
                </div>
                <div class="md-form col-md-3">
                    <label class="active pl-3" for="origen_queja_id">Origen de queja</label>
                    <input readonly disable class="form-control {{$input_color}}" id="origen_queja_id" type="text" name="origen_queja_id" 
                    value="{{$sancion->origen_queja_id ?? ''}}">
                </div>
                <div class="md-form col-md-3">
                    <label class="active pl-3" for="tipo_queja_id">Tipo de queja</label>
                    <input readonly disable class="form-control {{$input_color}}" id="tipo_queja_id" type="text" name="tipo_queja_id" 
                    value="{{$sancion->tipo_queja_id ?? ''}}">
                </div>
                <div class="md-form col-md-3">
                    <label class="active pl-3" for="folio_interno">Folio interno</label>
                    <input readonly disable class="form-control {{$input_color}}" id="folio_interno" type="text" name="folio_interno" 
                    value="{{$sancion->folio_interno ?? ''}}">
                </div>
            </div>
            <div class="form-row">
                <div class="md-form col-md-4">
                    <label class="active pl-3" for="asunto">Asunto</label>
                    <input readonly disable class="form-control {{$input_color}}" id="asunto" type="text" name="asunto" 
                    value="{{$sancion->asunto ?? ''}}">
                </div>

                <div class="md-form col-md-4">
                    <label class="active pl-3" for="tipo_sancion_id">Tipo de sancion</label>
		            <input readonly name="tipo_sancion_id" value="{{$sancion->tipo_sancion->name}}"
                         disable class="form-control {{$input_color}} ">
		    	</div>

                 <div class="md-form col-md-4">
                    <label class="active pl-3" for="estado_sancion_id">Estado sancion</label>
		            <input readonly name="estado_sancion_id" value="{{$sancion->estado_sancion->name}}"
                         disable class="form-control {{$input_color}} ">
		    	</div>  

                

            </div>
            <div class="form-row">    
               
                <div class="md-form col-md-3">
                    <label class="active pl-3" for="fecha_termino">Fecha de termino</label>

                    <input readonly disable id="fecha_termino" name="fecha_termino" class="form-control {{$input_color}}" type="text" 
                    value="{{$sancion->fecha_termino->format('Y-m-d') }}">
                </div>
                <div class="md-form col-md-6">
                    <label class="active pl-3" for="notas">Notas</label>
                    <input readonly disable class="form-control {{$input_color}}" id="notas" type="text" name="notas" 
                    value="{{$sancion->notas ?? ''}}">
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