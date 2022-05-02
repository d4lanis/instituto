<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Domicilio;
use Validator;
use Auth;

class DomicilioController extends Controller
{

    public function create(Request $request, Persona $persona)
    {
        $registro = new Domicilio;
    
        $route = route('domicilios.store', $persona->id);
        $method = "post";
        $title = " Registro nuevo";
        return view('expedientes.edit', 
                compact('registro','title','route','method','persona'));
                
                
    }

    public function store(Request $request, Persona $persona)
    {
        Validator::make($request->all(), [
            'colonia' => 'required',
            'calle' => 'required',
            'numero_exterior' => 'required',
            //'numero_interior' => 'required',
            'codigo_postal' => 'required',
            'poblacion_id' => 'required',
            'estado_id' => 'required',
            'municipio_id' => 'required',
        ])->validate();

    	if (!isset($request->domicilio_id))
            $registro = new Domicilio;
        else
            $registro = $persona->domicilio;
      
        $registro->colonia = $request->colonia;
        $registro->calle = $request->calle;
        $registro->numero_exterior = $request->numero_exterior;
        $registro->numero_interior = $request->numero_interior;
        $registro->codigo_postal = $request->codigo_postal;
        $registro->poblacion_id = $request->poblacion_id;
        $registro->estado_id = $request->estado_id;
        $registro->municipio_id = $request->municipio_id;
        $registro->persona_id = $persona->id;
        $registro->user_id = Auth::id();
    
        $registro->save();

        return back()->withSuccess("El domicilio  se guardo éxitosamente");
                    
    }
    


    public function domicilio(Persona $persona)
    {
        $route = route('domicilio',$persona->id);
        $page = 'domicilio';
        return view('expedientes.domicilios.form', compact('persona','route','page'));
    }
  
   

}
