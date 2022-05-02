<div class="col-md-12 pb-5">			
    <form id="domicilio_form" method="POST" action="{{route('domicilio',$persona->id)}}" class="ml-4">
        @csrf
        <input type="hidden" id="domicilio_id" name="domicilio_id" value="{{ old('id',$persona->domicilio->id ?? '') }}">
        <input type="hidden" id="estado"  value="{{ old('estado_id', $persona->domicilio->estado_id ?? 0) }}">
        <input type="hidden" id="municipio" value="{{ old('municipio_id', $persona->domicilio->municipio_id ?? 0) }}">
        <input type="hidden" id="poblacion" value="{{ old('poblacion_id', $persona->domicilio->poblacion_id ?? 0) }}">
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="calle">Calle</label>
              <input type="text" 
                  class="form-control" id="calle" name="calle"  
                  value="{{old('calle',$persona->domicilio->calle ?? '')}}">
            </div>
            <div class="form-group col-md-6">
              <label for="colonia">Colonia</label>
              <input type="text" class="form-control" id="colonia"  name="colonia" value="{{old('colonia',$persona->domicilio->colonia ?? '')}}">
            </div> 
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="numero_exterior">Numero exterior</label>
              <input type="text" class="form-control" id="numero_exterior"  name="numero_exterior" value="{{old('numero_exterior',$persona->domicilio->numero_exterior ?? '')}}">
            </div>
            <div class="form-group col-md-6">
              <label for="numero_interior">Numero interior</label>
              <input type="text" class="form-control" id="numero_interior"  name="numero_interior" value="{{old('numero_interior',$persona->domicilio->numero_interior ?? '')}}">
            </div>
        </div>
               
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="codigo_postal">Codigo Postal</label>
              <input type="text" class="form-control" id="codigo_postal"  name="codigo_postal" value="{{old('codigo_postal',$persona->domicilio->codigo_postal ?? '')}}">
            </div>
            <div class="col-md-6">
                <label class="active">Estado</label>
                <select class="mdb-select colorful-select" searchable="Buscar ..."
                    required id="estado_id" name="estado_id">
                </select>
            </div> 
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <label class="active">Municipio</label>
                <select class="mdb-select colorful-select" searchable="Buscar ..."
                    required id="municipio_id" name="municipio_id">
                </select>
            </div> 
            <div class="col-md-6">
                <label class="active">Población</label>
                <select class="mdb-select colorful-select" searchable="Buscar ..."
                    required id="poblacion_id" name="poblacion_id">
                </select>
            </div> 
        </div>
              
        <div class="pt-4 d-flex flex-row">
            <div class="ml-auto">
                <button class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
</div>

@push('scripts2')
  <script type="text/javascript">
      $(document).ready(function() { 
          dynamicDropdown("/estados", {{ old('estado_id', $persona->domicilio->estado_id ?? 0) }}, 'estado_id');
          dynamicDropdown("/municipios/" + $("#estado").val(), {{ old('municipio_id',$persona->domicilio->municipio_id ?? 0) }}, 'municipio_id');
          dynamicDropdown("/localidades/" + $("#municipio").val(), {{ old('poblacion_id',$persona->domicilio->poblacion_id ?? 0) }}, 'poblacion_id');

          $('select[name="estado_id"]').change(function(e){
                clearDropdown( $('select[name="municipio_id"]') );
                clearDropdown( $('select[name="poblacion_id"]') );
                var optionId = $('select[name="estado_id"] option:selected').val();
                dynamicDropdown("/municipios/" + optionId, 0, 'municipio_id');
            });

            $('select[name="municipio_id"]').change(function(e){
                clearDropdown( $('select[name="poblacion_id"]') );
                var optionId = $('select[name="municipio_id"] option:selected').val();
                dynamicDropdown("/localidades/" + optionId, 0, 'poblacion_id');
            });
        });
  </script>
@endpush