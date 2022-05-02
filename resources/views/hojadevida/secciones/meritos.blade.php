<hr width="100%" style="border-top:2px solid #e0e0e0;" > 
<div class="col-12" id="meritos" name="meritos">
            <label for="titulo" class="pt-3 pb-3">
            <h4><strong class="text-uppercase ">Meritos</strong></h4>
                 
            </label>
              @if($persona->meritos()->exists())
              @foreach($persona->meritos as $merito)
              <br>
              <label for="titulo" class="pt-3 pb-3">
                    <h6>Merito {{$loop->iteration}}</h6> 
                </label> 
            <div class="form-row">
                    <div class="md-form col-md-3">
                        <label class="active pl-3" for="fecha_reconocimiento">Fecha de reconocimiento</label>
                        <input readonly disable id="fecha_reconocimiento" name="fecha_reconocimiento" 
                            class="form-control {{$input_color}}" type="text" 
                            value="{{$merito->fecha_reconocimiento->format('Y-m-d') ?? ''}}">
                    </div>
                    <div class="md-form col-md-2">
                        <label class="active pl-3" for="merito_por_id">Merito por</label>
                        <input readonly name="merito_por_id" value="{{$merito->merito_por->name}}"
                                disable class="form-control {{$input_color}} ">
                    </div>  
                    <div class="md-form col-md-2">
                        <label class="active pl-3" for="tipo_merito_id">Tipo merito</label>
                        <input readonly name="tipo_merito_id" value="{{$merito->tipo_merito->name}}"
                                disable class="form-control {{$input_color}} ">
                    </div>      
                    <div class="md-form col-md-3">
                        <label class="active pl-3" for="folio_interno_merito">Folio interno</label>
                        <input readonly disable class="form-control {{$input_color}}" id="folio_interno_merito" type="text" name="folio_interno_merito" 
                        value="{{$merito->folio_interno ?? ''}}">
                    </div>
                   
                    <div class="md-form col-md-4">
                        <label class="active pl-3" for="notas_merito">Notas</label>
                        <input readonly disable class="form-control {{$input_color}}" id="notas_merito" type="text" name="notas_merito" 
                        value="{{$merito->notas ?? ''}}">
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