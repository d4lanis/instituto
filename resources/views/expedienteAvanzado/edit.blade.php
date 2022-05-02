@extends('layouts.master')

@section('main-content')

<div class="row col-12 mt-2">
    <div class="col-2">
        <div class="col-12 small text-capitalize z-depth-3 p-3 mt-2">
        <div class="d-flex justify-content-center pb-4">
					<img class="rounded img-fluid" height="100px" width="100px" alt="avatar" 
                    src="/storage/{{$persona->documento->foto_perfil ?? 'profile.png'}}"
                     >
				</div>
            <div class="font-italic m-1">
                <span class="badge-dark rounded p-1">Expediente </span>
            </div>
            <div class="pl-2">
                <span class="font-weight-bold">Nombre </span>
                <span class="text-danger h7">
                    {{ $persona->nombre }}
                </span>
            </div>
            <div class="pl-2">
                <span class="font-weight-bold">Ingreso </span>
                <!--<span class="text-primary"></span>  $persona->fecha_ingreso->format('d-m-Y') ?? '' }}-->
                <span class="text-primary"></span> {{ isset($persona->fecha_ingreso)? $persona->fecha_ingreso->format('d-m-Y') : '' }}
            </div>
            <div class="pl-2">
                <span class="font-weight-bold">Sexo </span>
                <!--<span class="text-primary"></span> $persona->sexo->name }}-->
                <span class="text-primary"></span> {{ isset($persona->sexo) ? $persona->sexo->name : ''}}
            </div>
            <div class="pl-2">
                <span class="font-weight-bold">Edad </span>
                <span class="text-primary"></span> {{ $persona->edad }}
            </div>
            <div class="pl-2">
                <span class="font-weight-bold">Tipo Sanguíneo </span>
                <!--<span class="text-primary">  $persona->tipo_sanguineo->name }}-->
                <span class="text-primary"> {{ isset($persona->tipo_sanguineo) ? $persona->tipo_sanguineo->name : ''}}
                    
                </span>
            </div>
        </div>
    </div>
    <div class="col-10">                     
        <div class="col-md-12 mt-2" id="menu">
            <ul class="nav nav-tabs md-tabs listamenu" id="myTabEx" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ $page=='evaluacion' ? 'active' : '' }}"
                      id="tab_evaluacion-tab" 
                        href="{{route('evaluaciones',$persona->id)}}" role="tab" aria-controls="tab_evaluacion"
                        aria-selected="true">Evaluacion</a>
                </li>
               <li class="nav-item">
                    <a class="nav-link {{ $page=='control' ? 'active' : '' }}"
                      id="tab_control-tab" 
                        href="{{route('control',$persona->id)}}" role="tab" aria-controls="tab_control"
                        aria-selected="true">Control y confianza</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link
                    {{ $page=='meritos' ? 'active' : '' }}"
                     id="tab_meritos-ex"
                        href="{{route('meritos',$persona->id)}}" role="tab" aria-controls="tab_meritos"
                        aria-selected="false">Meritos</a>
                </li>
               <li class="nav-item">
                    <a class="nav-link {{ $page=='cambios' ? 'active' : '' }}"
                     id="tab_cambio-ex" 
                        href="{{route('cambios',$persona->id)}}" role="tab" aria-controls="tab_cambio"
                        aria-selected="false">Cambios</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link
                    {{ $page=='sanciones' ? 'active' : '' }}"
                     id="tab_sanciones-ex"
                        href="{{route('sanciones',$persona->id)}}" role="tab" aria-controls="tab_sanciones"
                        aria-selected="false">Sanciones</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link    
                    {{ $page=='bajas' ? 'active' : '' }}"
                     id="tab_baja-ex" 
                        href="{{route('bajas',$persona->id)}}" role="tab" aria-controls="tab_baja"
                        aria-selected="false">Bajas</a>
                </li>
                

        
                
                <li class="nav-item ml-auto">
                    <a href="{{route('personas.index')}}" class="nav-link">
                        <span class="badge badge-info text-white p-2 z-depth-2">
                            <i class="fa fa-undo fa-lg" aria-hidden="true"></i>
                        </span>
                    </a>
                </li>
            </ul>            
        </div>
        <div class="col-md-12 p-5">
                
            @yield('evaluacion')
            @yield('evaluacion_table')
            @yield('control')
            @yield('control_table')
            @yield('cambio')
            @yield('cambio_table')  
            @yield('baja')
            @yield('baja_table') 
            @yield('sanciones')
            @yield('sanciones_table')
            @yield('merito') 
            @yield('merito_table')         
         

            

        </div>
    </div>
</div>
@endsection


