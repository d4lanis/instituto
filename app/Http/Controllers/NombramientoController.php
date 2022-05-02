<?php

namespace App\Http\Controllers;

use App\Models\Nombramiento;
use App\Models\Persona;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Storage;
use Auth;

class NombramientoController extends Controller
{
    
    public function nombramientos(Persona $persona, Nombramiento $nombramiento)
    {
        $route = route('nombramientos.create',$persona->id);
        $page = 'nombramientos';
        return view('expedientes.nombramiento.table', compact('persona','route','page'));
    }

  
    public function create(Persona $persona, Nombramiento $nombramiento)
    {
        $route = route('nombramientos.store',$persona->id);
        $page = 'nombramientos';
       
        return view('expedientes.nombramiento.form', compact('nombramiento','route', 'persona','page'));
    }

    
    public function store(Request $request,Persona $persona, Nombramiento $nombramiento)
    {

        //dd($request->all());
        $data=  Validator::make($request->all(), [
            'persona_id' => 'required',
            'nombre_cargo_grado' => 'required',
            'fecha_inicio' => 'required',
            'area_adscripcion' => 'required',
            'promedio' => 'required',
            'nombre_documento_certifica'=> 'required',
            'documento_pdf' => ''
          
           
        ])->validate();

   

       

        $rutadecarpeta = $persona->fullname;

        //  dd($rutadecarpeta);

        if (request('documento_pdf')) 
        {
           

           
                if (empty($persona->nombramientos->documento_pdf)) 
                {

                        /*esta linea crea la ruta */
                        $pathseguro = $request->file('documento_pdf')->store
                        ('expedientes/' . $rutadecarpeta, 'public');

                        /**esta linea manda ek archivo a la carpeta*/
                        $documento_pdfmove = $request->documento_pdf->move(
                            public_path("{$pathseguro}"),
                            $request->documento_pdf->getClientOriginalExtension()
                        );

                        $array_documento_pdf = ['documento_pdf' => $pathseguro];

                } 
                 
                else {
                  
              
                        $path=public_path();
                        $completepath=($path.'/'.'storage/');
                        $oldpdfseguro=$persona->nombramientos->documento_pdf;
                    
                    
                        $imagePathseguronew = $request->file('documento_pdf')->store
                        ('expedientes/'.$rutadecarpeta,
                        'public');
                    
                        $documento_pdfmovenew = $request->documento_pdf->move
                        (public_path("{$imagePathseguronew}"),
                        $request->documento_pdf->getClientOriginalExtension());

                        unlink($completepath.$oldpdfseguro);

                        Storage::delete($completepath.$oldpdfseguro);

                        $array_documento_pdf = ['documento_pdf' => $imagePathseguronew];

                    }
                      
   
        }

        


        if (!isset($request->nombramiento_id)){
            $registro = new Nombramiento;
            $registro->create(array_merge($data, 
            $array_documento_pdf ?? []
        
        ));
        
        if(Auth::user()->hasRole('user')){
            return redirect()->route('profile.nombramiento',$request->persona_id)
            ->withSuccess("El nombramiento se guardo éxitosamente");
        }
        
        return redirect()->route('nombramientos',$request->persona_id)
        ->withSuccess("El nombramiento se guardo éxitosamente");

        }

        else{
          
        $nombramiento = Nombramiento::find($request->nombramiento_id);

    

        $nombramiento->update(array_merge($data, $array_acta_pdf ?? []
        
        ));
    
    }
          
            /*y regresa con mensaje a la pagina anteriro*/

            return back()
                ->withSuccess("El nombramiento se modifico éxitosamente");
    }

    
   

   
    public function edit(Nombramiento $nombramiento)
    {
        $fecha_inicio= $nombramiento->fecha_inicio->toDateString();
       
        $persona=$nombramiento->persona;
       // dd($persona);

        $route = route('nombramientos.store',$persona->id);
        $page = 'nombramientos';
       
        return view('expedientes.nombramiento.form', 
        compact('nombramiento','route', 'persona','page','fecha_inicio'));
    }

    public function destroy(Nombramiento $nombramiento)
    {
        $nombre = $nombramiento->nombre_cargo_grado;
        $nombramiento->delete();
        return redirect()->back()->withSucess("Se eliminó el nombramiento de $nombre");
    }

    public function download($id, $tipo){
        
        $media = Nombramiento::where('id', $id)->get($tipo)->first()->$tipo;
        return Storage::disk('public')->download($media);
    }
}
