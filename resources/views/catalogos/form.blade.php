@extends('layouts.master')

@section ('content')

    <div class="container">
        <div class="card col-md-12 badge badge-light d-flex flex-row justify-content-between">
            <div class="pl-2 pt-3">
                <span class="h4 pt-1 pl-2 black-text text-capitalize">
                    {{"$title_form ".$current_catalogo['label']}}
                </span>
            </div>
            
            <div class="ml-auto d-flex flex-row p-2">
                <a href="{{route('catalogos.index','parent_id='.$current_catalogo['parent_id'])}}" 
                        class="m-1 p-1 badge-info z-depth-2">
                    <i class="fa fa-undo fa-2x" aria-hidden="true"></i>
                </a>
                <a href="#" class="m-1 badge-warning text-white p-1 z-depth-2"
                        onclick="document.getElementById('catalogo_form').submit();">
                    <i class="fa fa-save fa-2x" aria-hidden="true"></i>
                </a>
            </div>           
        </div> 
        <div class="d-flex flex-row mb-0 mt-4">
            <div class="col-md-12">
                <div class="d-flex flex-column p-2">
                    <form id="catalogo_form" method="POST" action="{{ $route }}" 
                    class="ml-4">

                        @csrf
                        {{ method_field($method) }}
                        <input type="hidden" name='parent_id' value="{{$catalogo->parent_id}}">

                        @if($catalogo->id > 0) 
                            <div class="form-group">
                                <label>Id</label>
                                <input type="text" name="id" value="{{$catalogo->id}}"
                                    class='form-control'>
                            </div>
                        @endif

                        <div class="form-group">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" name="name" id="name" 
                                    value="{{$catalogo->name}}" class='form-control'>
                            </div>
                        </div>

                        <div>
                            <hr>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection