<?php

namespace App\Http\Controllers;
use App\Models\ContactoReferencia;
use Illuminate\Http\Request;
use App\Models\Referencia;
use App\Models\Persona;
use Validator;

class ContactoReferenciaController extends Controller
{
   
    public function store(Request $request,  Referencia $referencia)
    {
     
       $data= Validator::make($request->all(), [
            'numero_telefono_referencia' => 'required',
            'numero_celular_referencia' => 'required',
            'email_referencia' => 'required',
         
           
        ])->validate();
        //dd($data);
    	if (!isset($request->contacto_referencia_id))
            $registro = new ContactoReferencia;
        else
        $registro = ContactoReferencia::find($request->contacto_referencia_id);
        
           
      
        $registro->numero_telefono_referencia = $request->numero_telefono_referencia;
        $registro->numero_celular_referencia = $request->numero_celular_referencia;
        $registro->email_referencia = $request->email_referencia;
      

        $registro->referencia_id = $referencia->id;
    
        $registro->save();

        return back()->withSuccess("El contacto  se guardo éxitosamente");
                    
    }
    

   
    public function contactoinfo(Referencia $referencia)
    {
        $page="referencia";

        $persona=$referencia->persona;

       // dd($referencia->contacto_referencia);

        //dd($persona);
        $route = route('contacto_referencias.store',$referencia->id);
       
        return view('expedientes.referencias.contacto.form', compact('referencia','route','persona','page'));
    }
}
