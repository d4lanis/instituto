<?php

namespace App\Http\Controllers;

use App\Models\DomicilioReferencia;
use Illuminate\Http\Request;
use App\Models\Referencia;
use Validator;

class DomicilioReferenciaController extends Controller
{
    
    public function store(Request $request,  Referencia $referencia)
    {
     
       $data= Validator::make($request->all(), [
            'calle_referencia' => 'required',
            'colonia_referencia' => 'required',
            'numero_exterior_referencia' => 'required',
            'codigo_postal_referencia' => 'required',
            'estado_referencia_id' => 'required',
            'municipio_referencia_id' => 'required',
            'poblacion_referencia_id' => 'required',
         
           
        ])->validate();
        //dd($data);
    	if (!isset($request->referencia_domicilio_id))
            $registro = new DomicilioReferencia;
        else

        $registro = DomicilioReferencia::find($request->referencia_domicilio_id);
   
           
        $registro->calle_referencia = $request->calle_referencia;
        $registro->colonia_referencia = $request->colonia_referencia;
        $registro->numero_exterior_referencia = $request->numero_exterior_referencia;
        $registro->codigo_postal_referencia = $request->codigo_postal_referencia;
        $registro->estado_referencia_id = $request->estado_referencia_id;
        $registro->municipio_referencia_id = $request->municipio_referencia_id;
        $registro->poblacion_referencia_id = $request->poblacion_referencia_id;

        $registro->referencia_id = $referencia->id;
    
        $registro->save();

        return back()->withSuccess("El domicilio  se guardo éxitosamente");
                    
    }
    



    public function domicilioinfo(Referencia $referencia)
    
    {

        $page="referencia";

        $persona=$referencia->persona;
        $route = route('domicilio_referencias.store',$referencia->id);
     
        return view('expedientes.referencias.domicilio.form', compact('referencia','route','persona','page'));
    }

}
