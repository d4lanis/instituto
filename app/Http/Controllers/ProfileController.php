<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\User;
use Auth;
use Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user = Auth::user();
        $persona = $user->persona;
        
        if(is_null($persona)){
            return redirect()->route('profile.create'); 
        }
        else{
            return redirect()->route('profile.edit',$persona->id);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $registro = new Persona;

        $route = route('profile.store'); 
        $method = "post";
        $title = "Registro nuevo";
        return view('profile.profile', 
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
            'numero_empleado' => '',
            'fecha_ingreso' => 'required',
            'nombre' => 'required',
            'paterno' => 'required',
            'materno' => 'required',
            'edad' => 'required|numeric|min:18|max:99',
            'fecha_nacimiento' => 'required',
            'lugar_nacimiento' => 'required',
            'sexo_id' => 'required',
            'estado_civil_id' => 'required',
            'tipo_sanguineo_id' => 'required',
            'categoria_puestos_id' => 'required',
            'status_id' => 'required',
            'rfc' => 'required',
            'curp' => 'required',
            'adscripcion_id' => '',
            'cargo_puesto_id' => 'required',
        ])->validate();

        $registro = new Persona;
      
        $registro->numero_empleado = $request->numero_empleado;
        $registro->fecha_ingreso = $request->fecha_ingreso;
        $registro->nombre = $request->nombre;
        $registro->paterno = $request->paterno;
        $registro->materno = $request->materno;
        $registro->edad = $request->edad;
        $registro->fecha_nacimiento = $request->fecha_nacimiento;
        $registro->lugar_nacimiento = $request->lugar_nacimiento;
        $registro->sexo_id = $request->sexo_id;
        $registro->estado_civil_id = $request->estado_civil_id;
        $registro->tipo_sanguineo_id = $request->tipo_sanguineo_id;
        $registro->categoria_puestos_id = $request->categoria_puestos_id;
        $registro->status_id = $request->status_id;
        $registro->rfc = $request->rfc;
        $registro->curp = $request->curp;
        $registro->adscripcion_id = $request->adscripcion_id;
        $registro->cargo_puesto_id = $request->cargo_puesto_id;
        $registro->user_id = Auth::id();
        $registro->save();

        $user = Auth::user();
        $user->persona_id = $registro->id;
        $user->save();

        return redirect()->route('profile')
            ->withSuccess("Expediente con el nombre de ".$registro->fullname
                ." se guardo éxitosamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        //
        $name = $persona->nombre;
        $registro = $persona;
        $route = route('profile.update',$persona->id);
        $method = "patch";
        $title = "$name  Edición registro (".$persona->id.")";
        return view('profile.profile', compact('registro','title','route','method','name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [

            //'numero_convocatoria' => 'required',
            'numero_empleado' => '',
            'fecha_ingreso' => 'required',
            'nombre' => 'required',
            'paterno' => 'required',
            'materno' => 'required',
            'edad' => 'required',
            'fecha_nacimiento' => 'required',
            'lugar_nacimiento' => 'required',
            'sexo_id' => 'required',
            'estado_civil_id' => 'required',
            'tipo_sanguineo_id' => 'required',
            'categoria_puestos_id' => 'required',
            'status_id' => 'required',
            'rfc' => 'required',
            'curp' => 'required',
            //'cuip' => '',
            'adscripcion_id' => '',
            'cargo_puesto_id' => 'required',
        ])->validate();
        
        $persona = Persona::findOrFail($id);
        $persona->update($request->only('numero_empleado','fecha_ingreso','nombre','paterno',
        'materno','edad','fecha_nacimiento','lugar_nacimiento','sexo_id','estado_civil_id','tipo_sanguineo_id','categoria_puestos_id',
        'status_id','rfc','curp','adscripcion_id','cargo_puesto_id'));
        return redirect()->route('profile')
        ->withSuccess("El expediente con el nombre de $request->nombre se modifico éxitosamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
