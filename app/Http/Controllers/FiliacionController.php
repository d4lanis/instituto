<?php

namespace App\Http\Controllers;

use App\Models\Filiacion;
use Illuminate\Http\Request;
use App\Models\Persona;

use Validator;

class FiliacionController extends Controller
{
   
    public function create(Request $request, Persona $persona)
    {
        $registro = new Filiacion;
    
        $route = route('media_filiacion.store', $persona->id);
        $method = "post";
        $title = " Registro nuevo";
        return view('expedientes.edit', 
                compact('registro','title','route','method','persona'));
    }

    public function store(Request $request, Persona $persona)
    {
     
        Validator::make($request->all(), [
            'complexion_id' => 'required',
            'color_piel_id' => 'required',
            'cantidad_de_cabello_id' => 'required',
            'color_de_cabello_id' => 'required',
            'forma_de_cabello_id' => 'required',
            'color_de_ojos_id' => 'required',
            'size_de_ojos_id' => 'required',
            'size_de_nariz_id' => 'required',
            'size_de_boca_id' => 'required',
            'forma_de_cara_id' => 'required',
        ])->validate();

    	if (!isset($request->media_filiacion_id))
            $registro = new Filiacion;
        else
            $registro = $persona->filiacion;
      
        $registro->complexion_id = $request->complexion_id;
        $registro->color_piel_id = $request->color_piel_id;
        $registro->cantidad_de_cabello_id = $request->cantidad_de_cabello_id;
        $registro->color_de_cabello_id = $request->color_de_cabello_id;
        $registro->forma_de_cabello_id = $request->forma_de_cabello_id;
        $registro->color_de_ojos_id = $request->color_de_ojos_id;
        $registro->size_de_ojos_id = $request->size_de_ojos_id;
        $registro->size_de_nariz_id = $request->size_de_nariz_id;
        $registro->size_de_boca_id = $request->size_de_boca_id;
        $registro->forma_de_cara_id = $request->forma_de_cara_id;
        $registro->persona_id = $persona->id;
    
        $registro->save();

        return back()->withSuccess("Media filiacion se guardo éxitosamente");
                    
    }
    



    public function mediafiliacion(Persona $persona)
    {

        
        $route = route('media_filiacion.store',$persona->id);
        $page = 'filiacion';
       
        return view('expedientes.media_filiacion.form', compact('persona','route','page'));
    }
    



}
