<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Font Awesome -->
    <link href="{{ asset('font_awesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('font_awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('MDB/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="{{ asset('MDB/css/mdb.min.css') }}" rel="stylesheet">
    <link href="{{ asset('MDB/css/addons/datatables.min.css') }}">
    <link href="{{ asset('MDB/css/addons/datatables-select.css') }}">

    <!-- Stepper CSS -->
    <link href="{{ asset('MDB/css/addons-pro/stepper.css') }}" rel="stylesheet">

    <script type="text/javascript" src="{{ asset('MDB/js/jquery-3.4.1.min.js') }}" ></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="{{ asset('MDB/js/popper.min.js') }}"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{ asset('MDB/js/bootstrap.min.js') }}"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{ asset('MDB/js/mdb.min.js') }}"></script>

    <!-- DataTables JavaScript -->
    <script type="text/javascript" src="{{ asset('MDB/js/addons/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('MDB/js/addons/datatables-select.js') }}"></script>
    <script type="text/javascript" src="{{ asset('MDB/js/modules/material-select.js') }}"></script>

    <!-- Stepper JavaScript -->
    <script type="text/javascript" src="{{ asset('MDB/js/addons-pro/stepper.js') }}"></script>

    <style type="text/css">
        label.required { color:red; }
    </style>

    @stack('css2')

    @yield('custom_css')

  

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};        
    </script>
</head>
