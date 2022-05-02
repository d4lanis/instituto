@extends('layouts.master')

@push('css2')
    <style type="text/css">
        label {
            color: #17a2b8;
            font-weight: bold;
            /*color: rgb(100,200,100);*/
        }
    </style>
@endpush

@section('content')
    <div class="row col-12 mt-2">
        <ul class="nav nav-tabs md-tabs col-md-12" id="myTabEx" role="tablist">
            <li class="nav-item">
                <a class="nav-link" role="tab" href="{{route('profile')}}">
                Datos Personales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" role="tab" href="{{route('profile.domicilio')}}">Domicilio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" role="tab" href="#">Documentos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" role="tab" href="#">Referencias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" role="tab" href="#">Escolaridad</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" role="tab" href="{{route('profile.media_filiacion')}}">
                Media Filiación</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" role="tab" href="#">Nombramientos</a>
            </li>
        </ul>            
    </div>
    <div class="col-md-12 mt-4 p-4">        
        @include('profile.forms.domicilio_referencias')
    </div>
@endsection

