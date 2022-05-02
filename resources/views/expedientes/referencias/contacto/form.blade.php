@extends('expedientes.edit') 
@section('contacto_referencias')
        <form method="POST" id="referencia_contacto_form" action="{{$route}}">			
       
        <input type="hidden" name="contacto_referencia_id" id="contacto_referencia_id" value="{{$referencia->contacto_referencia->id ?? ''}}">
        @csrf
       
        <div class="form-row">
        <div class="form-group col-md-6">
              <label for="email_referencia">Email</label>
            
              <input type="email" class="form-control" id="email_referencia"  name="email_referencia" 
             
              value="{{old('email_referencia',$referencia->contacto_referencia->email_referencia ?? '')}}">
            </div>

            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
              <label for="numero_telefono_referencia">Numero telefonico</label>
              <input type="text" class="form-control" id="numero_telefono_referencia"  name="numero_telefono_referencia" value=" {{old('numero_telefono_referencia',$referencia->contacto_referencia->numero_telefono_referencia ?? '')}}">
            </div>
            </div>

            <div class="form-row">
            <div class="form-group col-md-6">
              <label for="numero_celular_referencia">Numero celular</label>
              <input type="text" class="form-control" id="numero_celular_referencia"  name="numero_celular_referencia" value="{{old('numero_celular_referencia',$referencia->contacto_referencia->numero_celular_referencia ?? '')}}">
            </div>
            </div>
              
            <div class="pt-4 d-flex flex-row">
            
            <div class="ml-auto">
            <a href="{{route('referencia',$persona->id)}}" class="nav-link">
                        <span class="badge badge-info text-white p-2 z-depth-2">
                            <i class="fa fa-undo fa-lg" aria-hidden="true"></i>
                        </span>
                    </a>
                <button class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>

    @endsection