@extends('layouts.master')

@section('main-content')

<div class="row col-12 mt-2">
    <div class="col-2">
        <div class="col-12 small text-capitalize z-depth-3 p-3 mt-2">
        <div class="d-flex justify-content-center pb-4">
					<img class="rounded img-fluid" height="100px" width="100px" alt="avatar" 
                    src="/storage/{{$persona->perfil->foto_perfil ?? 'profile.png'}}"
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
                <!--<span class="text-primary"></span>  /*$persona->fecha_ingreso->format('d-m-Y') ?? '' */-->
                <span class="text-primary">{{ isset($persona->fecha_ingreso) ? $persona->fecha_ingreso->format('d-m-Y') : '' }}</span> 
            </div>
            <div class="pl-2">
                <span class="font-weight-bold">Sexo </span>
                <!--<span class="text-primary"></span>  $persona->sexo->name }}-->
                <span class="text-primary">{{ isset($persona->sexo) ? $persona->sexo->name : '' }}</span> 
            </div>
            <div class="pl-2">
                <span class="font-weight-bold">Edad </span>
                <span class="text-primary"></span> {{ $persona->edad }}
            </div>
            <div class="pl-2">
                <span class="font-weight-bold">Tipo Sanguíneo </span>
                <!--<span class="text-primary">  $persona->tipo_sanguineo->name }}</span>-->
                <span>{{isset($persona->tipo_sanguineo) ? $persona->tipo_sanguineo->name : '' }}</span>
            </div>
        </div>
    </div>
    <div class="col-10">                     
        <div class="col-md-12 mt-2" id="menu">
            <ul class="nav nav-tabs md-tabs listamenu" id="myTabEx" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ $page=='domicilio' ? 'active' : '' }}"
                      id="tab_domicilio-tab" 
                        href="{{route('domicilio',$persona->id)}}" role="tab" aria-controls="tab_domicilio"
                        aria-selected="true">Domicilio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $page=='documentos' ? 'active' : '' }}"
                      id="tab_documentos-tab" 
                        href="{{route('documentos',$persona->id)}}" role="tab" aria-controls="tab_documentos"
                        aria-selected="true">Documentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $page=='referencia' ? 'active' : '' }}"
                     id="tab_referencia-ex" 
                        href="{{route('referencia',$persona->id)}}" role="tab" aria-controls="tab_referencia"
                        aria-selected="false">Referencias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link    
                    {{ $page=='escolaridad' ? 'active' : '' }}"
                     id="tab_escolaridad-ex" 
                        href="{{route('estudios',$persona->id)}}" role="tab" aria-controls="tab_escolaridad"
                        aria-selected="false">Escolaridad</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link
                    {{ $page=='filiacion' ? 'active' : '' }}"
                     id="tab_media_filiacion-ex"
                        href="{{route('mediafiliacion',$persona->id)}}" role="tab" aria-controls="tab_media_filiacion"
                        aria-selected="false">Media filiacion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link
                    {{ $page=='nombramientos' ? 'active' : '' }}"
                     id="tab_nombramiento-ex"
                        href="{{route('nombramientos',$persona->id)}}" role="tab" aria-controls="tab_nombramiento"
                        aria-selected="false">Nombramientos</a>
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
                
            @yield('domicilio')
            @yield('documentos')    
            @yield('referencias_table')
            @yield('referencias')      
            @yield('escolaridad') 
            @yield('escolaridad_table') 
            @yield('nombramiento') 
            @yield('nombramiento_table') 
            @yield('filiacion')   
           
           
            @yield('contacto_referencias')  
            @yield('domicilio_referencias')
           

            

        </div>
    </div>
</div>
@endsection


