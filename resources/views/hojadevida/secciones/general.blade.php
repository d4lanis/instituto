<hr width="100%" style="border-top:2px solid #e0e0e0;" > 
<div class="col-12" id="informacion_basica" name="informacion_basica">
                <label for="titulo" class="pt-3 pb-3">
                <h4><strong class="text-uppercase ">Datos generales</strong></h4>
              
                </label>
           
            <div class="form-row">
                <div class="md-form col-md-3">
                    <label class="active pl-2 " for="nombre">Nombre</label>
                    <input readonly class="form-control {{$input_color}} text-uppercase" id="nombre" type="text" name="nombre" readonly
                    value="{{$persona->nombre ?? ''}}">
                </div>
                <div class="md-form col-md-2">
                    <label class="active pl-2 " for="paterno">Apellido paterno</label>
                    <input readonly class="form-control {{$input_color}} text-uppercase" id="paterno" type="text" name="paterno"
                     value="{{$persona->paterno ?? ''}}">
                </div>
                <div class="md-form col-md-2">
                    <label class="active pl-2 " for="materno">Apellido materno</label>
                    <input readonly class="form-control {{$input_color}} text-uppercase" id="materno" type="text" name="materno" 
                    value="{{$persona->materno ?? ''}}">
                </div>

              
                <div class="md-form col-md-3">
                <label class="active pl-2 " for="fecha_nacimiento">Fecha nacimiento</label>

                    <!--<input readonly id="fecha_nacimiento" name="fecha_nacimiento" 
                    class="form-control $input_color}} text-uppercase" type="text" 
                    value="$persona->fecha_nacimiento->format('Y-m-d')}}">-->
                    <input readonly id="fecha_nacimiento" name="fecha_nacimiento" 
                    class="form-control {{$input_color}} text-uppercase" type="text" 
                    value="{{isset($persona->fecha_nacimiento) ? $persona->fecha_nacimiento->format('Y-m-d') : ''}}">
                </div>
                <div class="md-form col-md-2">
                    <label class="active pl-2 " for="edad">Edad</label>
                    <input readonly class="form-control {{$input_color}} text-uppercase" id="edad" type="text" name="edad" readonly
                    value="{{$persona->edad ?? ''}}">
                </div>
            </div>

          <div class="form-row">
                <div class="md-form col-md-3">
                    <label class="active pl-2 " for="lugar_nacimiento">Lugar de nacimiento</label>
                    <input readonly class="form-control {{$input_color}} text-uppercase" id="lugar_nacimiento" type="text" name="lugar_nacimiento" 
                    value="{{$persona->lugar_nacimiento ?? ''}}">
                </div>
                <div class="md-form col-md-2">
                    <label class="active pl-2 " for="rfc">RFC</label>
                    <input readonly class="form-control {{$input_color}} text-uppercase" id="rfc" type="text" name="rfc" 
                    value="{{$persona->rfc ?? ''}}">
                </div>
                <div class="md-form col-md-3">
                    <label class="active pl-2 " for="curp">CURP</label>
                    <input readonly class="form-control {{$input_color}} text-uppercase" id="curp" type="text" name="curp" 
                    value="{{$persona->curp ?? ''}}">
                </div>
                <div class="md-form col-md-2">
                    <label class="active pl-2 " for="sexo_id">Sexo</label>
		            <!--<input readonly name="sexo_id" value="$persona->sexo->name}}"
                        readonly disable class="form-control $input_color}} text-uppercase ">-->
                        <input readonly name="sexo_id" value="{{isset($persona->sexo) ? $persona->sexo->name : ''}}"
                        readonly disable class="form-control {{$input_color}} text-uppercase ">
		    	</div> 
                <div class="md-form col-md-2">
                    <label class="active pl-2 " for="estado_civil_id">Estado civil</label>
		            <!--<input readonly name="estado_civil_id" value="$persona->estado_civil->name}}"
                        readonly disable class="form-control $input_color}} text-uppercase ">-->
                        <input readonly name="estado_civil_id" value="{{isset($persona->estado_civil) ? $persona->estado_civil->name : ''}}"
                        readonly disable class="form-control {{$input_color}} text-uppercase ">
		    	</div> 
          </div>

          <div class="form-row">
                <div class="md-form col-md-2">
                    <label class="active pl-2 " for="telefono">Telefono</label>
                    <input readonly class="form-control {{$input_color}} text-uppercase" id="telefono" type="text" name="telefono" 
                    value="{{--$persona->numero_convocatoria ?? ''--}}">
                </div>
                <div class="md-form col-md-2">
                    <label class="active pl-2 " for="celular">Celular</label>
                    <input readonly class="form-control {{$input_color}} text-uppercase" id="celular" type="text" name="celular" 
                    value="{{--$persona->numero_convocatoria ?? ''--}}">
                </div>
                <div class="md-form col-md-3">
                    <label class="active pl-2 " for="email">Email</label>
                    <input readonly class="form-control {{$input_color}} text-uppercase" id="email" type="text" name="email" 
                    value="{{--$persona->numero_convocatoria ?? ''--}}">
                </div>
                <div class="md-form col-md-3 offset-2">
                    <label class="active pl-2 " for="numero_convocatoria"># convocatoria</label>
                    <input readonly class="form-control {{$input_color}} text-uppercase" id="numero_convocatoria" type="text" name="numero_convocatoria" 
                    value="{{$persona->numero_convocatoria ?? ''}}">
                </div>
            </div>
     
        </div>