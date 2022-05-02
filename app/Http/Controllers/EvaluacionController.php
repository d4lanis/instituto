<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\Persona;
use Illuminate\Http\Request;
use Validator;

class EvaluacionController extends Controller
{
   
    public function destroy(Evaluacion $evaluacion)
    {
        $evaluacion->delete();
        return redirect()->back()->withSucess("Se eliminó la prueba de control y confianza");
    }

    public function evaluaciones(Persona $persona, Evaluacion $evaluacion)
    {
        //dd($persona->id);
        $route = route('evaluaciones.create',$persona->id);
        $page = 'evaluacion';
        return view('expedienteAvanzado.evaluaciones.table', compact('persona','route','page'));
    }

    public function nueva_evaluacion(Persona $persona, Evaluacion $evaluacion)
    {
        
        $route = route('evaluaciones.store',$persona->id);
        $page = 'evaluacion';
       
        return view('expedienteAvanzado.evaluaciones.form', compact('evaluacion','route', 'persona','page'));
    }

    public function store(Request $request)
    {       
        Validator::make($request->all(), [
            'persona_id' => 'required',
            'tipo_evaluacion_id' => 'required',
            'duracion' => '',
            'fecha_resultado' => 'required',
            'resultado_id' => 'required',
            'tiempo_de_validez' => 'required',
            'observaciones' => ''
          
           
        ])->validate();



        if (!isset($request->evaluacion_id))
            $registro = new Evaluacion;
        else
        $registro = Evaluacion::find($request->evaluacion_id);

            $registro->tipo_evaluacion_id = $request->tipo_evaluacion_id;
            $registro->duracion = $request->duracion;
            $registro->fecha_resultado = $request->fecha_resultado;
            $registro->resultado_id = $request->resultado_id;
            $registro->tiempo_de_validez = $request->tiempo_de_validez;
            $registro->observaciones = $request->observaciones;
        
            $registro->persona_id = $request->persona_id;
        
            $registro->save();
        return redirect()->route('evaluaciones',$request->persona_id)
        ->withSuccess("La evaluacion se guardo éxitosamente");
    }


    public function edit(Evaluacion $evaluacion)
    {

        $fecha_resultado= $evaluacion->fecha_resultado->toDateString();
        $persona=$evaluacion->persona;
       // dd($persona);

        $route = route('evaluaciones.store',$evaluacion->id);
        $page = 'evaluacion';
       
        return view('expedienteAvanzado.evaluaciones.form', 
        compact('evaluacion','route', 'persona','page','fecha_resultado'));
    }
}
