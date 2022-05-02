@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row p-2 btn-secondary d-flex justify-content-between z-depth-2">
            <div class="pt-2 pl-2 text-white h5 text-capitalize"> {{$title}} </div>
            <div class="ml-auto">
                <a href="{!! route('roles.index') !!}" class="px-1">
                    <span class="badge badge-info text-white p-2 z-depth-2">
                        <i class="fa fa-undo fa-2x" aria-hidden="true"></i>
                    </span>
                </a>
                <a href="#" class="px-2" 
                    onclick="document.getElementById('roles_form').submit();">
                    <span class="badge badge-warning text-white p-2 z-depth-2">
                        <i class="fa fa-save fa-2x" aria-hidden="true"></i>
                    </span>
                </a>
            </div>
        </div>
        <div class="mt-4">
            <form id="roles_form" method="POST" action="{{ $route }}" class="ml-4">

                @csrf

                {{ method_field($method) }}
                                   
                 @if($role->id > 0) 
                    <div class="row">
                        <label class="col-md-3 col-form-label text-md-right">Id</label>
                        <input class="col-md-6" id="id" type="text" name="id" 
                            value = "{{ $role->id }}"  readonly  disabled >
                    </div>
                @endif
                        
                <div class="row">
                    <label class="col-md-3 col-form-label text-md-right">Nombre</label>
                    <input class="col-md-6" id="name" type="text" name="name" 
                    value = "{{ $role->name }}"  {{ $readonly }} {{ $disabled }} >
                </div>
            </form>
        </div>
    </div> <!-- fin container -->
@endsection

@push('scripts2')
    <script>
    </script>
@endpush