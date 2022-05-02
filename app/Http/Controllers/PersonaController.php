<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Documento;
use Validator;



class PersonaController extends Controller
{
    public function index(Request $request)
    {
        $persona=Persona::get();
      
    	$route = route('personas.create');
       
        return view('expedientes.index', compact('persona','route'));

    }

    public function create(Request $request)
    {
       
        $registro = new Persona;
       
       
        $route = route('personas.store');
        $method = "post";
        $title = " Registro nuevo";
        return view('expedientes.form', 
                compact('registro','title','route','method'));
                
                
    }

    public function store(Request $request)
    {

        Validator::make($request->all(), [
           
            'numero_convocatoria' => 'required',
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
            'cuip' => '',
            'adscripcion_id' => '',
            'cargo_puesto_id' => 'required',

        ])->validate();
    	
        $registro = new Persona;
      
        $registro->numero_convocatoria = $request->numero_convocatoria;
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
        $registro->cuip = $request->cuip;
        $registro->adscripcion_id = $request->adscripcion_id;
        $registro->cargo_puesto_id = $request->cargo_puesto_id;
        $registro->user_id = $request->user()->id;
      

       
       
        $registro->save();

        return redirect()->route('personas.index')
        ->withSuccess("Expediente con el nombre de $request->nombre se guardo éxitosamente");

                    
    }
    

    
    public function edit(Persona $persona)

    
    {
        
        $name = $persona->nombre;
        $registro = $persona;
        $route = route('personas.update',$persona->id);
        $method = "patch";
        $title = "$name  Edición registro (".$persona->id.")";

        return view('expedientes.form', 
        		compact('registro','title','route','method','name'));
    }

    
    public function update(Request $request, Persona $persona)
    {
      
       // dd($request->all());
        Validator::make($request->all(), [

            'numero_convocatoria' => 'required',
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
            'cuip' => '',
            'adscripcion_id' => '',
            'cargo_puesto_id' => 'required',
        ])->validate();

        $persona->update($request->only('numero_convocatoria','numero_empleado','fecha_ingreso','nombre','paterno',
        'materno','edad','fecha_nacimiento','lugar_nacimiento','sexo_id','estado_civil_id','tipo_sanguineo_id','categoria_puestos_id',
        'status_id','rfc','curp','cuip','adscripcion_id','cargo_puesto_id'));
        return redirect()->route('personas.index')
        ->withSuccess("El expediente con el nombre de $request->nombre se modifico éxitosamente");


    }

  
    public function destroy(Persona $persona)
    {
        $nombre = $persona->nombre;
        
        $persona->delete();

         return redirect()->route('personas.index')
            ->withSuccess("El expediente con el nombre de $nombre se elimino éxitosamente");
    }

    public function hojadevida(Persona $persona)
    {
      
        $title = "Hoja de vida";
        $input_color = "text-primary text-uppercase";
        return view('hojadevida.form', compact('persona','title','input_color'));
    }

    

  
    
  

   
}
