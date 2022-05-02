@extends('layouts.master')

@section('main-content')

<div class="row col-12 mt-2">

    <div class="col-12">
        <div class="col-md-12 mt-2" id="menu">
            <ul class="nav nav-tabs md-tabs listamenu" id="myTabEx" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ $page=='general' ? 'active' : '' }}" id="tab_general-tab"
                        href="{{route('general')}}" role="tab" aria-controls="tab_general"
                        aria-selected="true">General</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ $page=='aprobados' ? 'active' : '' }}" id="tab_aprobados-tab"
                        href="{{route('aprobados')}}" role="tab" aria-controls="tab_aprobados"
                        aria-selected="true">Aprobados</a>
                </li>



                <li class="nav-item ml-auto">
                    <a href="{{route('home')}}" class="nav-link">
                        <span class="badge badge-info text-white p-2 z-depth-2">
                            <i class="fa fa-undo fa-lg" aria-hidden="true"></i>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-12 p-5">

            @yield('general')
            @yield('aprobados')





        </div>
    </div>
</div>
@endsection