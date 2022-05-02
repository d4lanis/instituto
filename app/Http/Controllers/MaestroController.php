<?php

namespace App\Http\Controllers;

use App\Models\Maestro;
use Illuminate\Http\Request;
use Validator;

class MaestroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route = route('maestros.create');
        return view('maestros.table', compact('route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $registro = new Maestro;
       
       
        $route = route('maestros.store');
        $method = "post";
        $title = " Registro nuevo";
        return view('maestros.form', 
                compact('registro','title','route','method'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
           
            'nombre' => 'required',
            
            'paterno' => 'required',
            'materno' => 'required'
          
        ])->validate();
    	
        $registro = new Maestro;
      
        $registro->paterno = $request->paterno;
        $registro->materno = $request->materno;
      
        $registro->nombre = $request->nombre;

        $registro->save();

        return redirect()->route('maestros.index')
        ->withSuccess("El maestro $request->nombre se agrego éxitosamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Maestro  $maestro
     * @return \Illuminate\Http\Response
     */
    public function show(Maestro $maestro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Maestro  $maestro
     * @return \Illuminate\Http\Response
     */
    public function edit(Maestro $maestro)
    {
        $name =  $maestro->paterno . ' ' . $maestro->materno . ' ' .  $maestro->nombre ;

        //dd($name);
  
        $registro = $maestro;
        $route = route('maestros.update',$maestro->id);
        $method = "patch";
        $title = "$name Edición registro (".$maestro->id.")";

        return view('maestros.form', 
        		compact('registro','title','route','method','name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Maestro  $maestro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Maestro $maestro)
    {
        Validator::make($request->all(), [
            'nombre' => 'required',
      
          
        ])->validate();

        $maestro->update($request->only('nombre'));
        return redirect()->route('maestros.index')
        ->withSuccess("El maestro $request->nombre se modifico éxitosamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Maestro  $maestro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maestro $maestro)
    {
        $nombre = $maestro->nombre;

        // dd($nombre);
         
         $maestro->delete();
 
          return redirect()->route('maestros.index')
             ->withSuccess("El maestro $nombre se elimino éxitosamente");
     }



     
    }

