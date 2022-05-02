@extends('layouts.master')

@section('content')
<div class="container">
    <div class="card col-md-12 badge badge-light d-flex flex-row justify-content-between">
        <div class="pl-2 pt-3">
            <span class="h4 pt-1 pl-2 black-text text-capitalize">{{$title}}</span>
        </div>

        <div class="ml-auto d-flex flex-row p-2">

            @if($validacion == 0)

            <a href="#" onclick="document.getElementById('cursos_form').submit();">
                <h4>
                    <span class="badge text-light bg-dark badge-pill"><i class="fa fa-save "></i> Guardar</span>
                </h4>
            </a>


            <a href="{{route('cerrar_carga_maestros',$curso->id)}}" class="pl-2">
                <h4>
                    <span class="badge badge-danger badge-pill"><i class="fa fa-lock"></i> Cerrar seleccion</span>
                </h4>
            </a>


            @endif


            <a href="{!! route('cursos.index') !!}" class="pl-2">
                <h4>
                    <span class="badge badge-info badge-pill"><i class="fa fa-undo "></i> </span>
                </h4>
            </a>

        </div>
    </div>
    <div class="mt-4">
        <form id="cursos_form" method="POST" action="{{ $route }}" class="ml-4">

            @csrf
            {{ method_field($method) }}
            <div class="card m-2 p-3">
                <table class="table text-uppercase" id="tabla_maestros">
                    <thead>
                        <th>Materia</th>
                        <th>Maestro</th>
                    </thead>
                    <tbody>
                        @foreach($curso->salonClases as $salon_clase)
                        <tr class="{{$loop->index % 2 == 0 ? 'grey lighten-1' : ''}}">
                            <td class="">
                                {{ $salon_clase->materia->nombre }}
                            </td>
                            <td>
                                <select id="item_{{$loop->index}}"
                                    name="salon_clase_{{$salon_clase->materia_id}}_{{$salon_clase->id}}"
                                    searchable="Buscar ..." class="" {{$salon_clase->readonly}}>
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </form>
    </div>
</div>
@endsection
@push('scripts2')
<script type="text/javascript">
    $(document).ready(function() {
        var tabla_maestros = $("#tabla_maestros").DataTable({
              paginate:       true,
              searching:      true,
              dom: '<"d-flex flex-row-reverse"f>t<"d-flex justify-content-between" ip>r'
        });

        @foreach($curso->salonClases as $salon_clase)
           dynamicDropdown("{{route('maestros')}}", 
           {{  $maestro=$salon_clase->maestro_id ? $salon_clase->maestro_id : 0  }}, "item_{{$loop->index}}");
        @endforeach
    });
</script>
@endpush