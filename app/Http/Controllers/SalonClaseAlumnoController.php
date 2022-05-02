<?php

namespace App\Http\Controllers;

use App\Models\SalonClaseAlumno;
use App\Models\SalonClase;
use App\Models\Curso;
use Illuminate\Http\Request;
use Validator;

class SalonClaseAlumnoController extends Controller
{

    public function store(Request $request)
    {

        //dd($request->all());
        $inputs = [];
        //dd($inputs);

        foreach ($request->except(['_token', '_method', 'curso_id']) as $elemento => $valor) {

            $elemento = explode(",", $elemento);
            $nombre = $elemento[0];
            $id = $elemento[1];

            $inputs[$id][$nombre] = $valor;
            //dd($elemento[1]);
        }
        //dd($inputs);

        foreach ($inputs as $salon_clase_id => $campos) {
            $registro = SalonClaseAlumno::find($salon_clase_id);

            $registro->calificacion = $campos['calificacion'];
            $registro->faltas = $campos['faltas'];
            $registro->extra = $campos['extra'];
            $registro->curso_id = $request->curso_id;

            $registro->save();
        }

        return back()
            ->withSuccess("El curso $request->nombre se guardo éxitosamente");
    }

    public function bloquear($salon_clase)
    {

        $salon_clase_id = $salon_clase;
        //dd($salon_clase);
        $registro = SalonClaseAlumno::where('salon_clase_id', $salon_clase_id)->get();

        //dd($registro);

        foreach ($registro as $alumno) {
            $registro = SalonClaseAlumno::find($alumno->id);
            $registro->status = 1;
            $registro->save();
        }







        return back()
            ->withSuccess("El curso con el nombre de  se bloqueo éxitosamente");
    }





    public function calificaciones(Request $request, Curso $curso)
    {
        $method = "post";

        $title = "Calificaciones";
        $route = route('calificaciones.store', $curso->id);
        $salon_clase_id = $request->salon_clase_id ?? 0;
        $salon_clase = SalonClase::find($salon_clase_id);

        $verificacion = SalonClaseAlumno::where('salon_clase_id', $salon_clase_id)->first();

        //dd($verificacion);



        return view('cursos.calificaciones', compact(
            'curso',
            'route',
            'method',
            'title',
            'salon_clase_id',
            'salon_clase',
            'verificacion'
        ));
    }

    public function materias(Curso $curso)
    {

        //dd($curso->alumnos->alumno);
        // foreach ($curso->alumnos as $item) {
        //     $results[] = ["name" => $item->alumno->nombre, "id" => $item->alumno->id]; 
        // }

        // return response()->json([
        //     'status' => 'ok',
        //     'data' => $results
        // ]);

        foreach ($curso->salonClases as $salon_clase) {
            $results[] = [
                "name" => $salon_clase->materia->nombre,
                "id" => $salon_clase->id
            ];
        }

        return response()->json([
            'status' => 'ok',
            'data' => $results
        ]);
    }

    public function destroy(SalonClaseAlumno $salonClaseAlumno)
    {
    }
}
