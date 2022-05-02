@extends('layouts.master')

@section('custom_css')
    <style type="text/css">
        #footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }   
    </style>
@endsection

@section('content')
    <div class="container col"> 
        <div>
        </div>
    </div>  
@endsection

@section('footer')
<div class="col-12 text-light bg-dark p-3 row" id="footer" style="font-size: 0.80em;">
    <div class="mr-auto p-2">
        <i class="fa fa-copyright"></i> 2020 - Fiscalía General del Estado de Coahuila - Dirección General de Informática y Telecomunicaciones
    </div>
    <div class="p-2">
        Contacto : 
        <a href="mailto:informatica@fge.coahuila.gob.mx" class="white-text">
            <i class="fa fa-envelope"></i>
            informatica.fge@coahuila.gob.mx
        </a>    
    </div>
</div>
@endsection

@push('scripts2')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#agreegment').change(function(e) {
                if(this.checked) {
                    $("#btn-acceso").show();
                    $("#btn-registro").show();
                } else {
                    $("#btn-acceso").hide();
                    $("#btn-registro").hide();
                }
            });
        });
    </script>
    
@endpush
