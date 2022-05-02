@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row p-2 btn-secondary d-flex justify-content-between z-depth-2">
            <div class="pt-2 pl-2 text-white h5"> {{$title}} </div>
            
            <div class="ml-auto">

                <a href="{!! route('users.index') !!}" class="px-1">
                    <span class="badge badge-info text-white p-2 z-depth-2">
                        <i class="fa fa-undo fa-2x" aria-hidden="true"></i>
                    </span>
                </a>
                <a href="#" class="px-1" 
                    onclick="document.getElementById('users_form').submit();">
                    <span class="badge badge-warning text-white p-2 z-depth-2">
                        <i class="fa fa-save fa-2x" aria-hidden="true"></i>
                    </span>
                </a>
            </div>
        </div>
        <div class="mt-4">
            <form id="users_form" method="POST" action="{{ $route }}" class="ml-4">
                @csrf
                {{ method_field($method) }}
                
                <div class="row col-12">
                    <div class="col-8">  

                        @if($user->id > 0) 
                            <div class="d-flex flex-row p-2">
                                <label class="col-md-3 col-form-label text-md-right">Id</label>
                                <div class="col-md-4">
                                    <input class="form-control" id="id" type="text" 
                                        name="id" value = "{{ $user->id }}" readonly  disabled >
                                </div>
                            </div>
                        @endif

                        <div class="d-flex flex-row p-2">
                            <label class="col-md-3 col-form-label text-md-right">
                                {{ __('auth.Name') }}</label>

                            <div class="col-md-4">
                                <input id="name" type="text" class="form-control" name="name" 
                                value="{{ old('name',$user->name) }}" required autofocus 
                                {{ $readonly }} {{ $disabled }} >

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex flex-row p-2">
                            <label class="col-md-3 col-form-label text-md-right">
                                {{ __('auth.E-Mail Address') }}</label>

                            <div class="col-md-4">
                                <input id="email" type="email" class="form-control" 
                                    name="email" value="{{ old('email',$user->email) }}" 
                                    required {{ $readonly }} {{ $disabled }}>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex flex-row p-2">
                            <label class="col-md-3 col-form-label text-md-right">
                                Nombre</label>
                            <div class="col-md-4">
                                <input class="form-control" id="nombre" type="text" name="nombre" 
                                    value = "{{ old('nombre',$user->nombre) }}" {{ $readonly }} {{ $disabled }} >
                            </div>
                        </div>

                        <div class="d-flex flex-row p-2">
                            <label class="col-md-3 col-form-label text-md-right">
                                Apellido paterno</label>
                            <div class="col-md-4">
                                <input class="form-control" id="paterno" type="text" name="paterno" 
                                    value = "{{ old('paterno',$user->paterno) }}"  {{ $readonly }} {{ $disabled }} >
                            </div>
                        </div>

                        <div class="d-flex flex-row p-2">
                            <label class="col-md-3 col-form-label text-md-right">
                                Apellido materno</label>
                            <div class="col-md-4">
                                <input class="form-control" id="materno" type="text" name="materno" 
                                    value = "{{ old('materno',$user->materno) }}"  {{ $readonly }} {{ $disabled }} >
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        @includeWhen($user->id > 0,'admin.users.roles_checkboxes')
                    </div>
                </div>
            </form>
        </div>
    </div> 
    <br>
    <br>
@endsection