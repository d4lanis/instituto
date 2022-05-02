<?php

namespace App\Http\Controllers;

use App\Models\Escolaridad;
use App\Models\SalonClaseAlumno;
use App\Models\Persona;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Log;
use Auth;

class EscolaridadController extends Controller
{
    
    public function estudios(Persona $persona, Escolaridad $escolaridad)
    {

        // $calificacion = SalonClaseAlumno::where('curso_alumno_id', 6)->get();
        // $totalMaterias = count($calificacion);
        // $totalCalification = 0;
        // foreach($calificacion as $x){
        //     $totalCalification += $x['calificacion'];
           
        //        }

        //        $promedio = $totalCalification / $totalMaterias;

        //     //    dd($promedio);
      
           
       
        $route = route('estudios.create',$persona->id);
        $page = 'escolaridad';
        return view('expedientes.escolaridad.table', compact('persona','route','page'));
    }

    public function nuevo_estudio(Persona $persona, Escolaridad $escolaridad)
    {
        
        $route = route('estudios.store',$persona->id);
        $page = 'escolaridad';
       
        return view('expedientes.escolaridad.form', compact('escolaridad','route', 'persona','page'));
    }

    public function store(Request $request)
    {       
        Validator::make($request->all(), [
            'persona_id' => 'required',
            'nombre_de_estudio' => 'required',
            'nombre_de_institucion' => 'required',
            'fecha_conclusion' => 'required',
            'fecha_inicio' => 'required',
            'estatus_id' => 'required',
            'nivel_escolar_id' => 'required',
        ])->validate();

        // Log::info("paso");
    	if (!isset($request->escolaridad_id))
            $registro = new Escolaridad;
        else
            $registro = Escolaridad::find($request->escolaridad_id);
      
        $registro->nombre_de_estudio = $request->nombre_de_estudio;
        $registro->nombre_de_institucion = $request->nombre_de_institucion;
        $registro->fecha_inicio = $request->fecha_inicio;
        $registro->fecha_conclusion = $request->fecha_conclusion;
        $registro->estatus_id = $request->estatus_id;
        $registro->nivel_escolar_id = $request->nivel_escolar_id;
        $registro->persona_id = $request->persona_id;
    
        $registro->save();
        // return response()->json(
        //      [
        //        'success' => true,
        //        'message' => 'Data inserted successfully'
        //      ]);

        if(Auth::user()->hasRole('user')){
            return redirect()->route('profile.escolaridad',$request->persona_id)
            ->withSuccess("El estudio se guardo éxitosamente");
        }
        
        return redirect()->route('estudios',$request->persona_id)
        ->withSuccess("El estudio se guardo éxitosamente");
    }


    public function edit(Escolaridad $escolaridad)
    {

        // $fecha_inicio= $escolaridad->fecha_inicio->toDateString();
        // $fecha_conclusion= $escolaridad->fecha_conclusion->toDateString();
        $persona=$escolaridad->persona;
       // dd($persona);

        $route = route('estudios.store',$escolaridad->id);
        $page = 'escolaridad';
       
        return view('expedientes.escolaridad.form', 
        compact('escolaridad','route', 'persona','page'));
    }


    public function destroy(Escolaridad $escolaridad)
    {
        $nombre = $escolaridad->nombre_de_estudio;
        $escolaridad->delete();
        return redirect()->back()->withSucess("Se eliminó el estudio de $nombre");
    }
}
