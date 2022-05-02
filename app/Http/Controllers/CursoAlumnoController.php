<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CursoAlumno;
use App\Models\SalonClaseAlumno;

use App\Models\Curso;
use Log;

class CursoAlumnoController extends Controller
{


    public function store(Request $request , Curso $curso)
    {

       
        $curso->alumnos->each->delete();
        $data=($request->alumnos_asignados);
        $alumnos_ids =explode(",", $data);
 
        foreach($alumnos_ids as $alumno_id){
            $registro = new CursoAlumno;
            $registro->persona_id = $alumno_id;
            $registro->curso_id = $curso->id;
            $registro->save();
            Log::info("registro creado" . $registro->id);
       }
       Log::error("registros creados" . count($alumnos_ids));

       return response()->json([
            'status' => 'ok'
        ]);

    }



    public function alumnos_asignacion(Curso $curso)
    {       
        $method = "post";
        $title = "Asignación de Alumnos";
        $route = route('asignacion_alumnos.store',$curso->id);
        $verificacion_de_alumnos =  CursoAlumno::where('curso_id',$curso->id)->first();
        $validacion = $verificacion_de_alumnos->status ?? 0;

       
        
        return view('cursos.alumnos', compact('curso','route','method','title','validacion'));
    }

   

    public function cerrar_carga_alumnos(Curso $curso)
    {       

       //dd( $curso->id);
       $registro = CursoAlumno::where('curso_id', $curso->id)->get();
      
        foreach($registro as $curso_alumno){

           $curso_alumno->status = 1;
           $curso_alumno-> save();
        
        }
       

     
        return redirect()->route('cursos.index')
        ->withSuccess("Alumnos asignados correctamente");
    }


}
