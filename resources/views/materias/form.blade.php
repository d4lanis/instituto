@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card col-md-12 badge badge-light d-flex flex-row justify-content-between">
            <div class="pl-2 pt-3">
                <span class="h4 pt-1 pl-2 black-text text-capitalize">{{$title}}</span>
            </div>
            
            <div class="ml-auto d-flex flex-row p-2">
                <a href="{!! route('materias.index') !!}" 
                        class="m-1 p-1 badge-info z-depth-2">
                    <i class="fa fa-undo fa-2x" aria-hidden="true"></i>
                </a>
                <a href="#" class="m-1 badge-warning text-white p-1 z-depth-2"
                        onclick="document.getElementById('materias_form').submit();">
                    <i class="fa fa-save fa-2x" aria-hidden="true"></i>
                </a>
            </div>           
        </div> 
        <div class="mt-4">
            <form id="materias_form" method="POST" action="{{ $route }}" class="ml-4">

                @csrf
                {{ method_field($method) }}
                                   
                <input type="hidden" id="tipo_materia" 
                    value="{{old('tipo_materia_id',$registro->tipo_materia_id ?? 0)}}">
                    <input type="hidden" id="categoria_materia" 
                    value="{{old('categoria_materia_id',$registro->categoria_materia_id ?? 0)}}">

                
                @if($registro->id > 0) 
                    <div class="row p-1">
                        <label class="col-md-3 col-form-label text-md-right">Id</label>
                        <input class="col-md-6" id="id" type="text" name="id" 
                            value = "{{ $registro->id }}"  readonly  disabled >
                    </div>

                  
                @endif
                        
                <div class="row p-1" > 
                    <label class="col-md-3 col-form-label text-md-right">Tipo materia</label>
                    <select id="tipo_materia_id" name="tipo_materia_id" searchable="Buscar ..."
                        class="mdb-select col-md-6 mt-1" required>
                    </select>
                </div>
                <div class="row p-1" > 
                    <label class="col-md-3 col-form-label text-md-right">Categoria materia</label>
                    <select id="categoria_materia_id" name="categoria_materia_id" searchable="Buscar ..."
                        class="mdb-select col-md-6 mt-1" required>
                    </select>
                </div>
                <div class="row p-1">
                    <label class="col-md-3 col-form-label text-md-right">Nombre</label>
                    <input class="col-md-6" id="nombre" type="text" name="nombre" 
                    value = "{{ $registro->nombre }}" >
                </div>

                 <div class="row p-1">
                    <label class="col-md-3 col-form-label text-md-right">Descripcion</label>
                    <input class="col-md-6" id="descripcion" type="text" name="descripcion" 
                    value = "{{ $registro->descripcion }}" >
                </div>

                 <div class="row p-1">
                    <label class="col-md-3 col-form-label text-md-right">Lugares</label>
                    <input class="col-md-6" id="lugares" type="number" name="lugares" 
                    value = "{{ $registro->lugares }}" >
                </div>

                 <div class="row p-1">
                    <label class="col-md-3 col-form-label text-md-right">Duracion</label>
                    <input class="col-md-6" id="duracion" type="number" name="duracion" 
                    value = "{{ $registro->duracion }}" >
                </div>

                 <div class="row p-1">
                    <label class="col-md-3 col-form-label text-md-right">Calificacion minima</label>
                    <input class="col-md-6" id="calificacion_minima" type="number" name="calificacion_minima" 
                    value = "{{ $registro->calificacion_minima }}" >
                </div>

                 <div class="row p-1">
                    <label class="col-md-3 col-form-label text-md-right">Grupo</label>
                    <input class="col-md-6" id="grupo_id" type="number" name="grupo_id" 
                    value = "{{ $registro->grupo_id }}" >
                </div>

            </form>
        </div>
    </div>
@endsection

@push('scripts2')
    <script type="text/javascript">
        $(document).ready(function() {
            dynamicDropdown("/items/{{ App\Models\Catalogo::TIPO_MATERIAS }}", 
                $("#tipo_materia").val(), 'tipo_materia_id');
            dynamicDropdown("/items/{{ App\Models\Catalogo::CATEGORIA_MATERIAS }}", 
                $("#categoria_materia").val(), 'categoria_materia_id');
        });   
    </script>
@endpush