<?php

namespace App\Http\Controllers;

use App\Models\Control;
use App\Models\Persona;
use Illuminate\Http\Request;
use Validator;

class ControlController extends Controller
{
  

    public function control(Persona $persona, Control $control)
    {
        //dd($persona->id);
        $route = route('control.create',$persona->id);
        $page = 'control';

        return view('expedienteAvanzado.controlyconfianza.table', compact('persona','route','page'));
    }

    public function nuevo_control(Persona $persona, Control $control)
    {
        
        $route = route('control.store',$persona->id);
        $page = 'control';
       
        return view('expedienteAvanzado.controlyconfianza.form', compact('control','route', 'persona','page'));
    }

    public function store(Request $request)
    {       
        Validator::make($request->all(), [
            'persona_id' => 'required',
            'tipo_control_confianza_id' => 'required',
            'motivo_control_id' => 'required',
            'duracion' => '',
            'numero_oficio' => 'required',
            'fecha_resultado' => 'required',
            'resultado_id' => 'required',
            'vigencia' => 'required',
            'observaciones' => '',
            'fecha_prueba_1' => '',
            'fecha_prueba_2' => '',
            'fecha_prueba_3' => '',
            'fecha_prueba_arma' => ''
          
           
        ])->validate();



        if (!isset($request->control_id))
            $registro = new Control;
        else
        $registro = Control::find($request->control_id);

            $registro->tipo_control_confianza_id = $request->tipo_control_confianza_id;
            $registro->motivo_control_id = $request->motivo_control_id;
            $registro->duracion = $request->duracion;
            $registro->numero_oficio = $request->numero_oficio;
            $registro->fecha_resultado = $request->fecha_resultado;
            $registro->fecha_prueba_1 = $request->fecha_prueba_1;
            $registro->fecha_prueba_2 = $request->fecha_prueba_2;
            $registro->fecha_prueba_3 = $request->fecha_prueba_3;
            $registro->fecha_prueba_arma = $request->fecha_prueba_arma;
            $registro->resultado_id = $request->resultado_id;
            $registro->vigencia = $request->vigencia;
            $registro->observaciones = $request->observaciones;
        
            $registro->persona_id = $request->persona_id;
        
            $registro->save();
        return redirect()->route('control',$request->persona_id)
        ->withSuccess("La prueba de control y confianza se guardo éxitosamente");
    }


    public function edit(Control $control)
    {

        $fecha_resultado= $control->fecha_resultado->toDateString();
        $vigencia= $control->vigencia->toDateString();
        $persona=$control->persona;
       // dd($persona);
       

        if (isset($control->fecha_prueba_arma)) {
          
            $fechas_general="display:none;";
            $fechas_arma="display:flex;";
        }else{
            $fechas_general="display:flex;";
            $fechas_arma="display:none;";
        }
        
       
        $route = route('control.store',$control->id);
        $page = 'control';
       
        return view('expedienteAvanzado.controlyconfianza.form', 
        compact('control','route', 'persona','page','fecha_resultado','vigencia',
    'fechas_general','fechas_arma'));
    }

    public function destroy(Control $control)
    {
        $nombre = $control->numero_oficio;
        $control->delete();
        return redirect()->back()->withSucess("Se eliminó la prueba de control y confianza de $nombre");
    }



}
