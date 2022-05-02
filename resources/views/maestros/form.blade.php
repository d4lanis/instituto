@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card col-md-12 badge badge-light d-flex flex-row justify-content-between">
            <div class="pl-2 pt-3">
                <span class="h4 pt-1 pl-2 black-text text-capitalize">{{$title}}</span>
            </div>
            
            <div class="ml-auto d-flex flex-row p-2">
                <a href="{!! route('maestros.index') !!}" 
                        class="m-1 p-1 badge-info z-depth-2">
                    <i class="fa fa-undo fa-2x" aria-hidden="true"></i>
                </a>
                <a href="#" class="m-1 badge-warning text-white p-1 z-depth-2"
                        onclick="document.getElementById('maestros_form').submit();">
                    <i class="fa fa-save fa-2x" aria-hidden="true"></i>
                </a>
            </div>           
        </div> 
        <div class="mt-4">
            <form id="maestros_form" method="POST" action="{{ $route }}" class="ml-4">

                @csrf
                {{ method_field($method) }}
                                   
               
              
                        
            	<div class="form-row">
								<div class="form-group col-md-4">
									<label for="paterno">Apellido Paterno *</label>
									<input type="text" class="form-control" id="paterno"  
									name="paterno" value="{{old('paterno',$registro->paterno ?? '')}}">
								</div>

								<div class="form-group col-md-4">
									<label for="materno">Apellido Materno *</label>
									<input type="text" class="form-control" id="materno"  
									name="materno" value="{{old('materno',$registro->materno ?? '')}}">
								</div>

								<div class="form-group col-md-4">
									<label for="nombre">Nombre *</label>
									<input type="text" class="form-control" id="nombre"  
									name="nombre" value="{{old('nombre',$registro->nombre ?? '')}}">
								</div>

							</div>


            </form>
        </div>
    </div>
@endsection
