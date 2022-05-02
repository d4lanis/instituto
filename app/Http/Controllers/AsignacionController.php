<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\Curso;
use App\Models\Maestro;
use App\Models\SalonClase;
use Illuminate\Http\Request;
use Log;

class AsignacionController extends Controller
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
    public function store(Request $request, Curso $curso)
    {

       // $curso->salonClases->each->delete();

     
        $inputs = $request->except(['_token','_method']);
 
      // dd($request->asignacion_id);
    
        foreach ($inputs as $materia => $maestro) {
            $materia = explode("_", $materia);
            $valor_materia=$materia[2];
            $id=$materia[3];


            Log::info("paso");
            if (!isset($id))
            $sc =  new SalonClase;
            else
                $sc = SalonClase::find($id);
         
           
            $sc->curso_id = $curso->id;
            $sc->materia_id = $valor_materia;
            $sc->maestro_id = $maestro;

            $sc->save();
       
          
         
        }

    
        
        return back()
                    ->withSuccess('Maestros asignados exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function show(Asignacion $asignacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Asignacion $asignacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asignacion $asignacion)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asignacion $asignacion)
    {
        //
    }

    public function asignacion(Curso $curso)
    {
        $method = "post";
        $title = "Asignación de Maestros";
        $route = route('asignacions.store',$curso->id);
        $verificacion_de_maestros =  SalonClase::where('curso_id',$curso->id)->first();
        $validacion = $verificacion_de_maestros->status ?? 0;
        
        return view('cursos.asignacion', compact('curso','route','method','title','validacion'));
    }

    public function maestro()
    {
       			
        $maestros =Maestro::select('nombre as name', 'id')->get();
       
        foreach ($maestros as $item) {
            $results[] = ["name" => $item->name, "id" => $item->id]; 
        }
      
            return response()->json([
                'status' => 'ok',
                'data' => $results
            ]);
        

    }

}
