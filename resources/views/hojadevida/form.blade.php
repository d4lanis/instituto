@extends('layouts.master')

@section('content')
    <div class="container text-uppercase">
        <div class="card col-md-12 badge badge-light d-flex flex-row justify-content-between">
            <div class="pl-2 pt-3">
                <span class="h4 pt-1 pl-2 black-text text-capitalize">{{$title}}</span>
            </div>
            
            <div class="ml-auto d-flex flex-row p-2">
                <a href="{!! route('personas.index') !!}" 
                        class="m-1 p-1 badge-info z-depth-2">
                    <i class="fa fa-undo fa-2x" aria-hidden="true"></i>
                </a>
                <a href="#" class="m-1 badge-warning text-white p-1 z-depth-2">
                    <i class="fa fa-save fa-2x" aria-hidden="true"></i>
                </a>
            </div>           
        </div> 
  
            <!-- profile -->
        <div class="col-12 pt-3" id="profile" name="profile">
                <div class="card-body d-flex flex-row">
                <div class="imagen-perfil col-2">
                        <img src="/storage/{{$persona->perfil->foto_perfil ?? 'profile.png'}}" 
                        class="rounded img-fluid mr-4" height="100px" width="100px" alt="avatar">
                        </div>
                    <!-- Content -->
                    <div class="detalles col-8">


                  
                 
                
                        <h4 class="card-title font-weight-bold mb-2 text-uppercase">
                        {{$persona->categoria_puestos->name ?? ''}}</h4>
                        <!-- Subtitle -->
                        <div class="row pb-2">
                        <div class="col-md-3">
                        <p class="card-text text-uppercase"><strong >Status:</strong> </p>
                              </div>
                             <div class="col-md-5">
                             <em class="text-primary"> <strong>{{$persona->status->name ?? ''}}</strong></em>
                            </div>
                            </div>
                            <div class="row pb-2">
                        <div class="col-md-3">
                        <p class="card-text text-uppercase"><strong># Empleado:</strong> </p>
                              </div>
                             <div class="col-md-5">
                             <em class="text-primary"><strong>{{$persona->numero_empleado ?? ''}}</strong></em>
                            </div>
                            </div>
                       

                    </div>

                </div>
        </div>

       
            <!-- Generales -->

        @include('hojadevida.secciones.general')
    
       
               <!-- Documentos -->
        @include('hojadevida.secciones.documentos')

         <!-- Escolaridad -->
        
        
        @include('hojadevida.secciones.escolaridad')

         <!-- Media filiacion -->
       

        @include('hojadevida.secciones.filiacion')
     
        <!-- Meritos -->
       

        @include('hojadevida.secciones.meritos')

        <!-- Sanciones -->
       

        @include('hojadevida.secciones.sanciones')


        <!-- Evaluaciones -->
       

        @include('hojadevida.secciones.evaluaciones')

        <!-- Control y confianza -->
            

        @include('hojadevida.secciones.control')

        <!-- Cambios-->
            

        @include('hojadevida.secciones.cambios')

        <!-- Bajas-->
            

        @include('hojadevida.secciones.bajas')
         
       
    </div>
@endsection
