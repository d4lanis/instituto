@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card col-md-12 badge badge-light d-flex flex-row justify-content-between">
            <div class="pl-2 pt-3">
                <span class="h4 pt-1 pl-2 black-text text-capitalize">{{$title}}</span>
            </div>
            
            <div class="ml-auto d-flex flex-row p-2">
                <a href="{!! route('cursos.index') !!}" 
                        class="m-1 p-1 badge-info z-depth-2">
                    <i class="fa fa-undo fa-2x" aria-hidden="true"></i>
                </a>
                <a href="#" class="m-1 badge-warning text-white p-1 z-depth-2"
                        onclick="document.getElementById('cursos_form').submit();">
                    <i class="fa fa-save fa-2x" aria-hidden="true"></i>
                </a>
            </div>           
        </div> 
        <div class="mt-4">
            <form id="cursos_form" method="POST" action="{{ $route }}" class="ml-4">
            
            <input type="hidden" id="planestudio"  value="{{ old('plan_estudio_id', $registro->plan_estudio_id ?? 0) }}">

            <input type="hidden" id="nivel_escolar"  value="{{ old('nivel_escolar_id', $registro->nivel_escolar_id ?? 0) }}">

                @csrf
                {{ method_field($method) }}
                                   
                <div class="row p-1">
             
                    	<label for="plan_estudio_id" class="col-md-3 col-form-label text-md-right">
                        Plan de estudios</label>
                    	<select id="plan_estudio_id" name="plan_estudio_id" 
                            class="col-md-6 browser-default custom-select">
						</select>
                
                    </div>

                    <div class="row p-1">
             
             <label for="nivel_escolar_id" class="col-md-3 col-form-label text-md-right">
             Nivel escolar</label>
             <select id="nivel_escolar_id" name="nivel_escolar_id" 
                 class="col-md-6 browser-default custom-select">
             </select>
     
         </div>
                   
            
                <div class="row p-1">
                    <label class="col-md-3 col-form-label text-md-right">Nombre</label>
                    <input class="col-md-6" id="nombre" type="text" name="nombre" 
                    value = "{{old('nombre', $registro->nombre )}}" >
                </div>

                 <div class="row p-1">
                    <label class="col-md-3 col-form-label text-md-right">Descripcion</label>
                    <input class="col-md-6" id="descripcion" type="text" name="descripcion" 
                    value = "{{ old('descripcion',$registro->descripcion ) }}" >
                </div>

                <div class="row p-1">
                 
                 <label for="fecha_inicio" class="col-md-3 col-form-label text-md-right" > 
                  Fecha inicio</label>
                 <input id="fecha_inicio" name="fecha_inicio" 
                     class="col-md-6 col-form" type="date"
                     value="{{ old('fecha_inicio', $fecha_inicio ?? '' ) }}">

                  </div>

                    <div class="row p-1">
                 
                    	<label for="fecha_termino" class="col-md-3 col-form-label text-md-right" > 
                         Fecha Termino</label>
                        <input id="fecha_termino" name="fecha_termino" 
                            class="col-md-6 col-form" type="date"
							value="{{ old('fecha_termino', $fecha_termino ?? '' ) }}">

                	</div>
                
                  
                

             

                <div class="row p-1">
                    <label class="col-md-3 col-form-label text-md-right">oficio numero</label>
                    <input class="col-md-6" id="oficio_numero" type="text" name="oficio_numero" 
                    value = "{{old('oficio_numero', $registro->oficio_numero )}}" >
                </div>

               
                <div class="row p-1">
                 
                    	<label for="oficio_fecha" class="col-md-3 col-form-label text-md-right" > 
                        Oficio fecha</label>
                        <input id="oficio_fecha" name="oficio_fecha" 
                            class="col-md-6 col-form" type="date"
							value="{{ old('oficio_fecha', $oficio_fecha ?? '' ) }}">

                	</div>

                    
              

                    <div class="row p-1">
                 
                    	<label for="kardex_fecha" class="col-md-3 col-form-label text-md-right" > 
                        Kardex Fecha</label>
                        <input id="kardex_fecha" name="kardex_fecha" 
                            class="col-md-6 col-form" type="date"
							value="{{ old('kardex_fecha', $kardex_fecha ?? '' ) }}">

                	</div>

                   
               
                   
              



            </form>
        </div>
    </div>
@endsection
@push('scripts2')
  <script type="text/javascript">
      $(document).ready(function() {
          dynamicDropdown("{{route('planestudio')}}", $("#planestudio").val(), 'plan_estudio_id');

          dynamicDropdown("/items/{{ App\Models\Catalogo::NIVEL_ESCOLAR }}", 
            	$("#nivel_escolar").val(), 'nivel_escolar_id');
         
        });
  </script>
@endpush