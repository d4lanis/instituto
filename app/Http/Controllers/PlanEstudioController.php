<?php

namespace App\Http\Controllers;

use App\Models\PlanEstudio;
use Illuminate\Http\Request;
use Validator;


class PlanEstudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
      
    	$route = route('planEstudios.create');
        return view('planestudios.table', compact('route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $registro = new PlanEstudio;
       
       
        $route = route('planEstudios.store');
        $method = "post";
        $title = " Registro nuevo";
        return view('planestudios.form', 
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
        //dd($request);
        Validator::make($request->all(), [
           
            'nombre' => 'required',
            'descripcion' => 'required',
           

        ])->validate();
    	
        $registro = new PlanEstudio;
      
        $registro->nombre = $request->nombre;

        $registro->descripcion = $request->descripcion;
      
      

       
       
        $registro->save();

        return redirect()->route('planEstudios.index')
        ->withSuccess("El plan de estudios de $request->nombre se guardo éxitosamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlanEstudio  $planEstudio
     * @return \Illuminate\Http\Response
     */
    public function show(PlanEstudio $planEstudio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanEstudio  $planEstudio
     * @return \Illuminate\Http\Response
     */
    public function edit(PlanEstudio $planEstudio)
    {

      

  //  $x=   PlanEstudio::where('id', $item)->firstOrFail();
   
        $name = $planEstudio->nombre;

        //dd($name);
  
        $registro = $planEstudio;
        $route = route('planEstudios.update',$planEstudio->id);
        $method = "patch";
        $title = "$name  Edición registro (".$planEstudio->id.")";

        return view('planestudios.form', 
        		compact('registro','title','route','method','name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlanEstudio  $planEstudio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlanEstudio $planEstudio)
    {
        Validator::make($request->all(), [
            'nombre' => 'required',
            'descripcion' => 'required',
          
        ])->validate();

        $planEstudio->update($request->only('nombre','descripcion'));
        return redirect()->route('planEstudios.index')
        ->withSuccess("El plan de estudios de $request->nombre se modifico éxitosamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanEstudio  $planEstudio
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlanEstudio $planEstudio)
    {
        $nombre = $planEstudio->nombre;

       // dd($nombre);
        
        $planEstudio->delete();

         return redirect()->route('planEstudios.index')
            ->withSuccess("El plan de estudios con el nombre de $nombre se elimino éxitosamente");
    }
}
