<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;
use Validator;

class MateriaController extends Controller
{
  
    public function index()
    {
 
        $materia=Materia::get();
      
    	$route = route('materias.create');
        return view('materias.index',compact('route','materia'));
    }

 
    public function create(Request $request)
    {
       
        $registro = new Materia;
       
       
        $route = route('materias.store');
        $method = "post";
        $title = " Registro nuevo";
        return view('materias.form', 
                compact('registro','title','route','method'));
                
                
    }

  
    public function store(Request $request)
    {

        //dd($request);
        Validator::make($request->all(), [
            'nombre' => 'required',
            'descripcion' => 'required',
            'lugares' => 'required',
            'duracion' => 'required',
            'calificacion_minima' => 'required',
            'grupo_id' => 'required',

        ])->validate();
    	
        $registro = new Materia;
       
        $registro->tipo_materia_id = $request->tipo_materia_id;
        $registro->categoria_materia_id = $request->categoria_materia_id;
        $registro->nombre = $request->nombre;
        $registro->descripcion = $request->descripcion;
        $registro->lugares = $request->lugares;
        $registro->duracion = $request->duracion;
        $registro->calificacion_minima = $request->calificacion_minima;
        $registro->grupo_id = $request->grupo_id;

       
        $registro->save();

        return redirect()->route('materias.index')
        ->withSuccess("La materia $request->nombre se guardo éxitosamente");

                    
    }
    

  
    public function edit(Materia $materia)
    {
        
        $name = $materia->nombre;
        //dd($name);
        $registro = $materia;
        $route = route('materias.update',$materia->id);
        $method = "patch";
        $title = "$name  Edición registro (".$materia->id.")";

        return view('materias.form', 
        		compact('registro','title','route','method','name'));
    }

   
    public function update(Request $request, Materia $materia)
    {
      
        Validator::make($request->all(), [
            'nombre' => 'required',
            'descripcion' => 'required',
            'lugares' => 'required',
            'duracion' => 'required',
            'calificacion_minima' => 'required',
            'grupo_id' => 'required',
        ])->validate();

        $materia->update($request->only('tipo_materia_id','categoria_materia_id','nombre','descripcion','lugares','duracion','calificacion_minima','grupo_id'));
        return redirect()->route('materias.index')
        ->withSuccess("La materia $request->nombre se modifico éxitosamente");


    }

  
    public function destroy(Materia $materia)
    {
        $nombre = $materia->nombre;
        
        $materia->delete();

         return redirect()->route('materias.index')
            ->withSuccess("La materia $nombre se elimino éxitosamente");
    }
}
