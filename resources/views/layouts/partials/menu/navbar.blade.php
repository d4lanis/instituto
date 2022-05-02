<!-- Navbar -->
<nav class="navbar fixed-top navbar-toggleable-md navbar-blue scrolling-navbar">

    <div class="d-flex row pl-1">
        <img src="{{asset('images/logos/fgj_logo.png')}}" width="50px">
        <a href="{{route('home')}}" class="breadcrumb pt-4 white-text">
            <i class="fa fa-home fa-2x px-1" style="margin-top: -10px;"></i> 
            <span class="font-italic h5 d-none d-sm-block" style="margin-top: -5px;">
                Seguimiento y Control del Servicio Profesional de Carrera
            </span>
        </a>  
    </div>

    <!--Navbar links-->
    <ul class="nav navbar-nav nav-flex-icons ml-auto">
        @if (!Auth::guest())         
            <li class="nav-item mt-2">
                <span class="h6">Bienvenido - {{ Auth::user()->name }} </span>
            </li>    
            <li class="nav-item dropdown">
                <a class="nav-link px-3"
                    href="#" id="btn-denuncia" id="navbarDropdownMenuLink" 
                    data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bars white-text"></i>
                </a>
                <div class="dropdown-menu header-notifications animated dropdown-menu-right" 
                    aria-labelledby="navbarDropdownMenuLink">
                    <ul class="nav navbar-nav nav-flex-icons ml-auto">
                        @hasanyrole( 'super_admin' )
                            <li>
                                <a class="nav-link" href="{{route('catalogos.index')}}">
                                    <i class="fa fa-table" aria-hidden="true"></i> 
                                    Catalogos
                                </a>
                            </li>
                         
                            <li>
                                <a class="nav-link" 
                                    href="{{route('list.index',App\Models\Catalogo::ESCOLARIDAD)}}">
                                    <i class="fa fa-table" aria-hidden="true"></i> 
                                    Escolaridad
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{route('users.index')}}">
                                    <i class="fa fa-table" aria-hidden="true"></i> 
                                    Usuarios
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{route('roles.index')}}">
                                    <i class="fa fa-table" aria-hidden="true"></i> 
                                    Roles
                                </a>
                            </li>                            
                        @endhasanyrole   
                                           
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="change_password"
                                data-toggle="modal" data-target="#change_password_modal">
                                <i class="fa fa-lock"></i>
                                Contraseña
                            </a>
                        </li>
                        <hr width="90%" style="border-top:1px solid black;"/>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                Salir
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link btn waves-effect" 
                    href="{{route('login')}}" id="btn-acceso">
                    <span class="hidden-sm-down text-warning h5 mx-3"> Acceso </span>
                </a>
            </li>
            @if( Route::has('register') )
                <li class="nav-item">
                    <a class="nav-link btn waves-effect" 
                        href="{{route('register')}}" id="btn-acceso">
                        <span class="hidden-sm-down text-warning h5 mx-3"> Registro </span>
                    </a>
                </li>
            @endif
        @endif
    </ul>
    <!--/Navbar links-->

</nav>
<!-- /.Navbar -->
