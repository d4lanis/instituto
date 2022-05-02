@extends('reportes.edit')
@section('general')
<div class="container">
    <div class="row">
        <div class="col-12-md">
            <div class="card-block">
                <div id="table-container" class="p-3 col-12">
                    <table class="table table-striped" cellspacing="0" width="100%" id="reporte_table">
                        <thead>
                            @foreach($report['header'] as $columna)
                            <th>{{$columna}}</th>
                            @endforeach
                        </thead>

                        @foreach ($report['data'] as $mes => $valores)
                        <tr>
                            <td>{{$mes}}</td>
                            <td>{{$valores['hombre']}}</td>
                            <td>{{$valores['mujer']}}</td>
                            <td>{{$valores['total']}}</td>
                        </tr>
                        @endforeach

                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td>{{$report['footer']['hombre']}}</td>
                                <td>{{$report['footer']['mujer']}}</td>
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