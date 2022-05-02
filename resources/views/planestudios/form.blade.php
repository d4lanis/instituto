@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card col-md-12 badge badge-light d-flex flex-row justify-content-between">
            <div class="pl-2 pt-3">
                <span class="h4 pt-1 pl-2 black-text text-capitalize">{{$title}}</span>
            </div>
            
            <div class="ml-auto d-flex flex-row p-2">
                <a href="{!! route('planEstudios.index') !!}" 
                        class="m-1 p-1 badge-info z-depth-2">
                    <i class="fa fa-undo fa-2x" aria-hidden="true"></i>
                </a>
                <a href="#" class="m-1 badge-warning text-white p-1 z-depth-2"
                        onclick="document.getElementById('planEstudios_form').submit();">
                    <i class="fa fa-save fa-2x" aria-hidden="true"></i>
                </a>
            </div>           
        </div> 
        <div class="mt-4">
            <form id="planEstudios_form" method="POST" action="{{ $route }}" class="ml-4">

                @csrf
                {{ method_field($method) }}
                                   
               
              
                        
            
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


            </form>
        </div>
    </div>
@endsection
