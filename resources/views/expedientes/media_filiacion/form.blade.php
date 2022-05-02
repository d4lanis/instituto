
@extends('expedientes.edit') 
@section('filiacion')
<div class="col-md-12 pb-5">			
    <form id="media_filiacion_form" method="POST" action="{{route('media_filiacion.store',$persona->id)}}" class="ml-4">
        @csrf
        <input type="hidden" id="media_filiacion_id" name="media_filiacion_id" 
              value="{{ old('id',$persona->filiacion->id ?? '') }}">
           
                <input type="hidden" id="complexion" 
			        	value="{{ old('complexion_id', $persona->filiacion->complexion_id ?? 0) }}">
			    <input type="hidden" id="color_piel" 
			        	value="{{ old('color_piel_id', $persona->filiacion->color_piel_id ?? 0) }}">
				<input type="hidden" id="cantidad_cabello" 
			        	value="{{ old('cantidad_de_cabello_id', $persona->filiacion->cantidad_de_cabello_id ?? 0) }}">
                        <input type="hidden" id="color_cabello" 
			        	value="{{ old('color_de_cabello_id', $persona->filiacion->color_de_cabello_id ?? 0) }}">
			    <input type="hidden" id="forma_cabello" 
			        	value="{{ old('forma_de_cabello_id', $persona->filiacion->forma_de_cabello_id ?? 0) }}">
				<input type="hidden" id="color_ojos" 
			        	value="{{ old('color_de_ojos_id', $persona->filiacion->color_de_ojos_id ?? 0) }}">
                        <input type="hidden" id="size_ojos" 
			        	value="{{ old('size_de_ojos_id', $persona->filiacion->size_de_ojos_id ?? 0) }}">
			    <input type="hidden" id="size_nariz" 
			        	value="{{ old('size_de_nariz_id', $persona->filiacion->size_de_nariz_id ?? 0) }}">
				<input type="hidden" id="size_boca" 
			        	value="{{ old('size_de_boca_id', $persona->filiacion->size_de_boca_id ?? 0) }}">
                        <input type="hidden" id="forma_cara" 
			        	value="{{ old('forma_de_cara_id', $persona->filiacion->forma_de_cara_id ?? 0) }}">
       
        <div class="form-row">


        
        <div class="col-md-6">
                <label class="active">Complexion</label>
                <select class="mdb-select " searchable="Buscar ..."
                    required id="complexion_id" name="complexion_id">
                </select>
            </div> 
            <div class="col-md-6">
                <label class="active">Color piel</label>
                <select class="mdb-select " searchable="Buscar ..."
                    required id="color_piel_id" name="color_piel_id">
                </select>
            </div> 
        </div>

        <div class="form-row">
        <div class="col-md-6">
                <label class="active">Cantidad de cabello</label>
                <select class="mdb-select " searchable="Buscar ..."
                    required id="cantidad_de_cabello_id" name="cantidad_de_cabello_id">
                </select>
            </div> 
            <div class="col-md-6">
                <label class="active">Color de cabello</label>
                <select class="mdb-select " searchable="Buscar ..."
                    required id="color_de_cabello_id" name="color_de_cabello_id">
                </select>
            </div> 
        </div>

        <div class="form-row">
        <div class="col-md-6">
                <label class="active">Forma de cabello</label>
                <select class="mdb-select " searchable="Buscar ..."
                    required id="forma_de_cabello_id" name="forma_de_cabello_id">
                </select>
            </div> 
            <div class="col-md-6">
                <label class="active">Color de ojos</label>
                <select class="mdb-select " searchable="Buscar ..."
                    required id="color_de_ojos_id" name="color_de_ojos_id">
                </select>
            </div> 
        </div>

        <div class="form-row">
        <div class="col-md-6">
                <label class="active">Tamaño de ojos</label>
                <select class="mdb-select " searchable="Buscar ..."
                    required id="size_de_ojos_id" name="size_de_ojos_id">
                </select>
            </div> 
            <div class="col-md-6">
                <label class="active">Tamaño de nariz</label>
                <select class="mdb-select " searchable="Buscar ..."
                    required id="size_de_nariz_id" name="size_de_nariz_id">
                </select>
            </div> 
        </div>
        
        <div class="form-row">
        <div class="col-md-6">
                <label class="active">Tamaño de boca</label>
                <select class="mdb-select " searchable="Buscar ..."
                    required id="size_de_boca_id" name="size_de_boca_id">
                </select>
            </div> 
            <div class="col-md-6">
                <label class="active">Forma de cara</label>
                <select class="mdb-select " searchable="Buscar ..."
                    required id="forma_de_cara_id" name="forma_de_cara_id">
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
@endsection
@push('scripts2')
	<script type="text/javascript">
		$(document).ready(function() {
            dynamicDropdown("/items/{{ App\Models\Catalogo::COMPLEXION }}", 
            	$("#complexion").val(), 'complexion_id');
                dynamicDropdown("/items/{{ App\Models\Catalogo::COLOR_PIEL }}", 
            	$("#color_piel").val(), 'color_piel_id');
                dynamicDropdown("/items/{{ App\Models\Catalogo::CANTIDAD_CABELLO }}", 
            	$("#cantidad_cabello").val(), 'cantidad_de_cabello_id');
                dynamicDropdown("/items/{{ App\Models\Catalogo::COLOR_CABELLO }}", 
            	$("#color_cabello").val(), 'color_de_cabello_id');
                dynamicDropdown("/items/{{ App\Models\Catalogo::FORMA_CABELLO }}", 
            	$("#forma_cabello").val(), 'forma_de_cabello_id');
                dynamicDropdown("/items/{{ App\Models\Catalogo::COLOR_OJOS }}", 
            	$("#color_ojos").val(), 'color_de_ojos_id');
                dynamicDropdown("/items/{{ App\Models\Catalogo::SIZE_OJOS }}", 
            	$("#size_ojos").val(), 'size_de_ojos_id');
                dynamicDropdown("/items/{{ App\Models\Catalogo::SIZE_NARIZ }}", 
            	$("#size_nariz").val(), 'size_de_nariz_id');
                dynamicDropdown("/items/{{ App\Models\Catalogo::SIZE_BOCA }}", 
            	$("#size_boca").val(), 'size_de_boca_id');
				dynamicDropdown("/items/{{ App\Models\Catalogo::FORMA_CARA }}", 
            	$("#forma_cara").val(), 'forma_de_cara_id');
        });
	</script>
@endpush
