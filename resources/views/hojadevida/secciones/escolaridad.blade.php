
<hr width="100%" style="border-top:2px solid #e0e0e0;" > 
        <div class="col-12" id="escolaridad" name="escolaridad">
                <label for="titulo" class="pt-3 pb-3">
                <h4><strong class="text-uppercase ">Escolaridad</strong></h4>
                  
                </label>
                @if($persona->estudios()->exists())
                @foreach($persona->estudios as $estudio)
                <br>
              <label for="titulo" class="pt-3 pb-3">
                    <h6 class="text-uppercase"><strong><em> {{$estudio->nombre_de_estudio}}</em></strong></h6> 
                </label> 
            <div class="form-row">
                <div class="md-form col-md-3">
                    <label class="active pl-3" for="fecha_inicio">Fecha de inicio</label>
                    <input readonly disable id="fecha_inicio" name="fecha_inicio" 
                    class="form-control {{$input_color}}" type="text" 
                    value="{{$estudio->fecha_inicio ?? ''}}">
                </div>
                <div class="md-form col-md-3">
                    <label class="active pl-3" for="nombre_de_estudio">Nombre de curso o carrera</label>
                    <input readonly disable  class="form-control {{$input_color}}" id="nombre_de_estudio" type="text" name="nombre_de_estudio" 
                    value="{{$estudio->nombre_de_estudio ?? ''}}">
                </div>
                <div class="md-form col-md-3">
                    <label class="active pl-3" for="nombre_de_institucion">Nombre de institucion</label>
                    <input readonly disable  class="form-control {{$input_color}}" id="nombre_de_institucion" type="text" name="nombre_de_institucion" 
                    value="{{$estudio->nombre_de_institucion ?? ''}}">
                </div>
              
                <div class="md-form col-md-2">
                    <label class="active pl-3" for="nivel_escolar_id">Nivel escolar</label>
		            <input readonly name="nivel_escolar_id" value="{{$estudio->nivel_escolar->name}}"
                         disable class="form-control {{$input_color}} ">
		    	</div> 
                <div class="md-form col-md-2">
                    <label class="active pl-3" for="estatus_id">Estatus</label>
		            <input readonly name="estatus_id" value="{{$estudio->estatus->name}}"
                         disable class="form-control {{$input_color}} ">
		    	</div> 
                <div class="md-form col-md-3">
                    <label class="active pl-3" for="promedio">Promedio</label>
                    <input readonly disable  class="form-control {{$input_color}}" id="promedio" type="text" name="promedio" 
                    value="{{$estudio->promedio ?? ''}}">
                </div>
                <div class="md-form col-md-3">
                <label class="active pl-3" for="fecha_conclusion">Fecha de conclusion</label>

                    <input readonly disable id="fecha_conclusion" name="fecha_conclusion" 
                    class="form-control {{$input_color}}" type="text" 
                    value="{{$estudio->fecha_conclusion ?? ''}}">
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