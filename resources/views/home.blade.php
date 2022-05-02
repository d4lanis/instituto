@extends('layouts.master')

@section('content')
<div class="d-flex flex-wrap">
    @hasanyrole( 'reclutamiento|super_admin|director' )
    <div class="d-flex flex-column m-2 p-2  text-center">
        <a href="{{route('personas.index')}}">
            <i class="deep-purple-text btn-rounded fa fa-users p-4 fa-3x z-depth-3" aria-hidden="true"></i>
        </a>
        <span class="h6 mt-2">Personal</span>
    </div>
    <div class="d-flex flex-column m-2 p-2  text-center">
        <a href="{{ route('colegiados.index') }}">
            <i class="text-dark btn-rounded fa fa-file-text-o p-4 fa-3x z-depth-3"></i>
        </a>
        <span class="h6 mt-2">Colegiados</span>
    </div>
    <div class="d-flex flex-column m-2 p-2  text-center">
        <a href="{{ route('eventos.index') }}">
            <i class="text-warning btn-rounded fa fa-calendar p-4 fa-3x z-depth-3"></i>
        </a>
        <span class="h6 mt-2">Eventos</span>
    </div>
    <div class="d-flex flex-column m-2 p-2  text-center">
        <a href="{{ route('general') }}">
            <i class="text-light btn-rounded fa fa-bar-chart p-4 fa-3x z-depth-3"></i>
        </a>
        <span class="h6 mt-2">Reportes</span>
    </div>
    @endhasanyrole
    @hasanyrole( 'instructor|super_admin|director' )
    <div class="d-flex flex-column m-2 p-2  text-center">
        <a href="{{route('maestros.index')}}">
            <i class="deep-orange-text btn-rounded fa fa-graduation-cap p-4 fa-3x z-depth-3" aria-hidden="true"></i>
        </a>
        <span class="h6 mt-2">Maestros</span>
    </div>

    <div class="d-flex flex-column m-2 p-2  text-center">
        <a href="{{route('materias.index')}}">
            <i class="green-text btn-rounded fa fa-book p-4 fa-3x z-depth-3"></i>
        </a>
        <span class="h6 mt-2">Materias</span>
    </div>

    <div class="d-flex flex-column m-2 p-2  text-center">
        <a href="{{route('planEstudios.index')}}">
            <i class="red-text btn-rounded fa fa-list-alt p-4 fa-3x z-depth-3"></i>
        </a>
        <span class="h6 mt-2">Plan de estudios</span>
    </div>

    <div class="d-flex flex-column m-2 p-2  text-center">
        <a href="{{ route('cursos.index') }}">
            <i class="text-primary btn-rounded fa fa-list-ul p-4 fa-3x z-depth-3"></i>
        </a>
        <span class="h6 mt-2">Cursos</span>
    </div>
    @endhasanyrole
    @hasrole('user')
    <div class="d-flex flex-column m-2 p-2  text-center">
        <a href="{{route('profile')}}">
            <i class="deep-purple-text btn-rounded fa fa-user p-4 fa-3x z-depth-3" aria-hidden="true"></i>
        </a>
        <span class="h6 mt-2">Datos Personales</span>
    </div>
    @endhasrole
</div>
@endsection