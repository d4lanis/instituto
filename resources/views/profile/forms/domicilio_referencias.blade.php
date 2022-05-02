<form id="referencia_domicilio_form" method="POST" action="{{$route}}" class="ml-4">
    @csrf
    <input type="hidden" name="referencia_domicilio_id" id="referencia_domicilio_id" value="{{$referencia->domicilio_referencia->id ?? ''}}">
    <input type="hidden" id="estado"  value="{{ old('estado_referencia_id', $referencia->domicilio_referencia->estado_referencia_id ?? 0) }}">
    <input type="hidden" id="municipio" value="{{ old('municipio_referencia_id', $referencia->domicilio_referencia->municipio_referencia_id ?? 0) }}">
    <input type="hidden" id="poblacion" value="{{ old('poblacion_referencia_id', $referencia->domicilio_referencia->poblacion_referencia_id ?? 0) }}">

   



    <div class="form-row">
        <div class="form-group col-md-6">
          <label for="calle_referencia">Calle_referencia</label>
          <input type="text" 
              class="form-control" id="calle_referencia" name="calle_referencia"  
              value="{{old('calle_referencia',$referencia->domicilio_referencia->calle_referencia ?? '')}}">
        </div>
        <div class="form-group col-md-6">
          <label for="colonia_referencia">Colonia_referencia</label>
          <input type="text" class="form-control" id="colonia_referencia"  name="colonia_referencia" value="{{old('colonia_referencia',$referencia->domicilio_referencia->colonia_referencia ?? '')}}">
        </div> 
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
          <label for="numero_exterior_referencia">Numero exterior</label>
          <input type="text" class="form-control" id="numero_exterior_referencia"  name="numero_exterior_referencia" value="{{old('numero_exterior_referencia',$referencia->domicilio_referencia->numero_exterior_referencia ?? '')}}">
        </div>
        <div class="form-group col-md-6">
          <label for="codigo_postal_referencia">Codigo Postal</label>
          <input type="text" class="form-control" id="codigo_postal_referencia"  name="codigo_postal_referencia" value="{{old('codigo_postal_referencia',$referencia->domicilio_referencia->codigo_postal_referencia ?? '')}}">
        </div>
    </div>


    <div class="form-row">
    <div class="col-md-6">
            <label class="active">Estado</label>
            <select class="mdb-select colorful-select" searchable="Buscar ..."
                required id="estado_referencia_id" name="estado_referencia_id">
            </select>
        </div> 
        <div class="col-md-6">
            <label class="active">Municipio</label>
            <select class="mdb-select colorful-select" searchable="Buscar ..."
                required id="municipio_referencia_id" name="municipio_referencia_id">
            </select>
        </div> 
    </div>


    <div class="form-row">
    <div class="col-md-6">
            <label class="active">Población</label>
            <select class="mdb-select colorful-select" searchable="Buscar ..."
                required id="poblacion_referencia_id" name="poblacion_referencia_id">
            </select>
        </div> 
        
    </div>
          
    <div class="pt-4 d-flex flex-row">
        <div class="ml-auto">
        <a href="{{route('profile.referencias')}}" class="nav-link">
                    <span class="badge badge-info text-white p-2 z-depth-2">
                        <i class="fa fa-undo fa-lg" aria-hidden="true"></i>
                    </span>
                </a>
            <button class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>

@push('scripts2')


<script type="text/javascript">
  $(document).ready(function() {
      dynamicDropdown("/items/{{ App\Models\Catalogo::MEXICO }}", $("#estado").val(), 'estado_referencia_id');
      dynamicDropdown("/items/" + $("#estado").val(), $("#municipio").val(), 'municipio_referencia_id');
      dynamicDropdown("/items/" + $("#municipio").val(), $("#poblacion").val(), 'poblacion_referencia_id');

      $('select[name="estado_referencia_id"]').change(function(e){
            clearDropdown( $('select[name="municipio_referencia_id"]') );
            clearDropdown( $('select[name="poblacion_referencia_id"]') );
            var optionId = $('select[name="estado_referencia_id"] option:selected').val();
            dynamicDropdown("/items/" + optionId, 0, 'municipio_referencia_id');
        });

        $('select[name="municipio_referencia_id"]').change(function(e){
            clearDropdown( $('select[name="poblacion_referencia_id"]') );
            var optionId = $('select[name="municipio_referencia_id"] option:selected').val();
            dynamicDropdown("/items/" + optionId, 0, 'poblacion_referencia_id');
        });
    });
</script>
@endpush