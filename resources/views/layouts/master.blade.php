<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

    @include ('layouts.partials.header')

    <body class="fixed-sn black-skin">
        <header>
            <!-- Navbar -->
            @include ('layouts.partials.menu.navbar')
            <!-- FixedButton -->
            @yield('fixedbutton')
        </header>
        
        <div>
            <main>
                @include('layouts.partials.messages')
            </main>
            @yield('main-content')
            <div class="col-md-12 mt-2">
                @yield('content')
            </div>

            @yield('footer')

            @include('layouts.partials.modal.perfil_change_password')
            
            <!-- SCRIPTS -->
            @include ('layouts.partials.scripts')          

        </div>
    </body>

</html>