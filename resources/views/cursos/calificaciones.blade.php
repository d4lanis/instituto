@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card col-md-12 badge badge-light d-flex flex-row justify-content-between">
            <div class="pl-2 pt-3 d-flex flex-row">
                <span class="h4 pt-1 pl-2 black-text text-capitalize">{{$title}}</span>
                <div class="pl-4 row">
                    <span class="pt-1 h4">Asignatura</span>
                    <select class="ml-2" searchable="Buscar ..."
                         id="salon_clase_id" name="salon_clase_id">
                    </select>
                </div> 
            </div>
            
            <div class="ml-auto d-flex flex-row p-2">
            @if(isset($salon_clase))
                @if($verificacion->status == 0)


                <a href="#"  onclick="document.getElementById('calificaciones_form').submit();">
                <h4>
                <span class="badge text-light bg-dark badge-pill"><i class="fa fa-save " ></i> Guardar</span>
                </h4>
                </a>


               
                @endif
                @endif
            @if(isset($salon_clase))
            @if($verificacion->status == 0)
            

                <a href="{{route('bloquear',$salon_clase)}}" class="pl-2">
                <h4>
                <span class="badge badge-danger badge-pill"><i class="fa fa-lock" ></i> Cerrar captura</span>
                </h4>
                </a>
               
                @endif
                @endif

                <a href="{!! route('cursos.index') !!}" class="pl-2">
                <h4>
                <span class="badge badge-info badge-pill"><i class="fa fa-undo " ></i> </span>
                </h4>
                </a>

             
            </div>           
        </div> 
        @if(isset($salon_clase))
            <div class="mt-4">
                <form id="calificaciones_form" method="POST" action="{{ $route }}" class="ml-4">
                    @csrf
                    {{ method_field($method) }}
                    <input type="hidden" name="curso_id" id="curso_id" value="{{$curso->id ?? ''}}">
                    <div class="card m-2 p-3">
                        <table class="table text-uppercase">
                            <thead>
                                <th>Id</th>
                                <th>Alumno</th>
                                <th>Calificación</th>
                                <th>Faltas</th>
                                <th>Extra</th>
                            </thead>
                            <tbody>
                                @foreach($salon_clase->alumnos as $salon_clase_alumno)
                                  <tr class="">
                                    <td> {{$salon_clase_alumno->id}}<input type="hidden" id="salon_clase_alumnos_id,{{$salon_clase_alumno->id}}"
                                        name="salon_clase_alumnos_id,{{$salon_clase_alumno->id}}"
                                        value="{{$salon_clase_alumno->id}}"
                                        ></td>
                                    <td>{{$salon_clase_alumno->nombre_alumno}}</td>
                                    <td>
                                        <input 
                                        id="calificacion,{{$salon_clase_alumno->id}}"
                                        name="calificacion,{{$salon_clase_alumno->id}}" 
                                        value="{{$salon_clase_alumno->calificacion}}"
                                        {{$salon_clase_alumno->readonly}} >
                                        
                                    </td>
                                    <td>
                                    <input 
                                        id="faltas,{{$salon_clase_alumno->id}}"
                                        name="faltas,{{$salon_clase_alumno->id}}"
                                        value="{{$salon_clase_alumno->faltas}}"
                                        {{$salon_clase_alumno->readonly}}
                                        >
                                    </td>
                                    <td>
                                    <input 
                                        id="extra,{{$salon_clase_alumno->id}}"
                                        name="extra,{{$salon_clase_alumno->id}}"
                                        value=" {{$salon_clase_alumno->extra}}"
                                        {{$salon_clase_alumno->readonly}}
                                        >
                                   </td>
                                  </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                  
                </form>
            </div>
        @else
            <br>
            <span class="red-text p-2">
                Nota: favor de seleccionar una materia
            </span>
        @endif
    </div>
@endsection

@push('scripts2')
  <script type="text/javascript">

    $(document).ready(function() {
        dynamicDropdown("{{route('materias',$curso->id)}}", {{$salon_clase_id ?? 0}}, "salon_clase_id");

        $('select[name="salon_clase_id"]').change(function(e){
            var salon_clase_id = $('select[name="salon_clase_id"] option:selected').val();
            window.location.href = "{{route('calificaciones',$curso->id)}}" + 
                "?salon_clase_id="+salon_clase_id;
        });
    });

  </script>
@endpush