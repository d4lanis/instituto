<?php

namespace App\Http\Controllers;

use App\Models\PlanEstudioMateria;
use App\Models\PlanEstudio;
use App\Models\Materia;
use Illuminate\Http\Request;
use Validator;
use Log;

class PlanEstudioMateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , PlanEstudio $planEstudio)
    {
        

      //  dd($request->all());
        //PlanEstudioMateria::where('plan_estudio_id', $planEstudio)->delete();
        // remueve todas las materias
        $planEstudio->materias->each->delete();

        //dd($planEstudio);
        
        $data=($request->materias_asignadas);
        $partes =explode(",", $data);
        //dump($partes);

        foreach($partes as $nombre => $valor){
            $registro = new PlanEstudioMateria;
            $registro->materia_id = $valor;
            $registro->plan_estudio_id = $planEstudio->id;
            $registro->save();
       }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlanEstudioMateria  $planEstudioMateria
     * @return \Illuminate\Http\Response
     */
    public function show(PlanEstudioMateria $planEstudioMateria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanEstudioMateria  $planEstudioMateria
     * @return \Illuminate\Http\Response
     */
    public function edit(PlanEstudioMateria $planEstudioMateria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlanEstudioMateria  $planEstudioMateria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlanEstudioMateria $planEstudioMateria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanEstudioMateria  $planEstudioMateria
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlanEstudioMateria $planEstudioMateria)
    {
        //
    }

    public function lista( PlanEstudio $planEstudio)
    {
        //$page="referencia";

       // $persona=$referencia->persona;

       // dd($referencia->contacto_referencia);
      //   $materias_asignadas=$planEstudio->materias ?? collect();
      
      // $materias_disponibles=Materia::whereNotIn('id', $materias_asignadas->pluck('id')->toArray())->get();


      // $materia=$materia->get();
   //  $materia = array("blue", "red", "green", "blue", "blue");
  
 
   
     //dd($materia);
        $route = route('planestudiomaterias.store',$planEstudio->id);
       
        return view('planestudios.listado', compact('route','planEstudio'));
    }

}
