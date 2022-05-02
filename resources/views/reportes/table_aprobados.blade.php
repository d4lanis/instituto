@extends('reportes.edit')
@section('aprobados')
<div class="container">
    <div class="row">
        <div class="col-12-md">
            <div class="card-block">
                <div id="table-container" class="p-3 col-12">
                    <table class="table table-striped" cellspacing="0" width="100%" id="reporte_table">
                        <thead>
                            @foreach($report['header'] as $columna)
                            <th class="thead-dark">{{$columna}}</th>
                            @endforeach
                        </thead>

                        @foreach ($report['data'] as $mes => $valores)
                        <tr>


                            <td>{{$mes}}</td>
                            <td class="table-info">{{$valores['hombre']['aprobado']}}</td>
                            <td class="table-info">{{$valores['hombre']['no aprobado']}}</td>
                            <td class="table-info">{{$valores['hombre']['sin clasificar']}}</td>
                            <td class="table-warning">{{$valores['mujer']['aprobado']}}</td>
                            <td class="table-warning">{{$valores['mujer']['no aprobado']}}</td>
                            <td class="table-warning">{{$valores['mujer']['sin clasificar']}}</td>
                            <td>{{$valores['total']}}</td>

                        </tr>
                        @endforeach

                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td class="table-info">{{$report['footer']['hombre']['aprobado']}}</td>
                                <td class="table-info">{{$report['footer']['hombre']['no aprobado']}}</td>
                                <td class="table-info">{{$report['footer']['hombre']['sin clasificar']}}</td>
                                <td class="table-warning">{{$report['footer']['mujer']['aprobado']}}</td>

                                <td class="table-warning">{{$report['footer']['mujer']['no aprobado']}}</td>
                                <td class="table-warning">{{$report['footer']['mujer']['sin clasificar']}}</td>
                                <td>{{$report['footer']['total']}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>



    </div>
    <div class="row">
        <div class="col-12-md">
            <div class="col-6-md">
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>
        </div>


    </div>

</div>

@endsection
@push('scripts2')

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>



@endpush