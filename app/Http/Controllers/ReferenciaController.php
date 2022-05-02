<?php

namespace App\Http\Controllers;
use App\Models\ContactoReferencia;
use App\Models\Referencia;
use App\Models\Persona;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Log;

class ReferenciaController extends Controller
{

    public function create(Persona $persona, Referencia $referencia)
    {
        
        $route = route('referencias.store',$persona->id);
        $page = 'referencia';
       
        return view('expedientes.referencias.form', compact('referencia','route', 'persona','page'));
    }

    public function store(Request $request)
    {       
        Validator::make($request->all(), [
            'persona_id' => 'required',
            'paterno_referencia' => 'required',
            'materno_referencia' => 'required',
            'nombre_referencia' => 'required',
            'sexo_id' => 'required',
            'parentesco_id' => 'required',
            'ocupacion_referencia' => 'required',
        ])->validate();

        Log::info("paso");
    	if (!isset($request->referencia_id))
            $registro = new Referencia;
        else
            $registro = Referencia::find($request->referencia_id);
      
        $registro->paterno_referencia = $request->paterno_referencia;
        $registro->materno_referencia = $request->materno_referencia;
        $registro->nombre_referencia = $request->nombre_referencia;
        $registro->sexo_id = $request->sexo_id;
        $registro->parentesco_id = $request->parentesco_id;
        $registro->ocupacion_referencia = $request->ocupacion_referencia;
        $registro->persona_id = $request->persona_id;
    
        $registro->save();
        // return response()->json(
        //      [
        //        'success' => true,
        //        'message' => 'Data inserted successfully'
        //      ]);


        return redirect()->route('referencia',$request->persona_id)
        ->withSuccess("La referencia se guardo éxitosamente");
    }

    public function edit(Referencia $referencia)
    {

        
        $persona=$referencia->persona;
       // dd($persona);

        $route = route('referencias.store',$referencia->id);
        $page = 'referencia';
       
        return view('expedientes.referencias.form', 
        compact('referencia','route', 'persona','page'));
    }



    public function destroy(Referencia $referencia)
    {
        $nombre = $referencia->nombre_referencia;
        $referencia->delete();
        return redirect()->back()->withSucess("Se eliminó el registro $nombre");
    }

   
   

    public function referencia(Referencia $referencia, Persona $persona)
    {
        $route = route('referencias.store',$referencia->id);
        $page = 'referencia';
        return view('expedientes.referencias.table', 
            compact('referencia','route', 'persona','page'));
    }
}
