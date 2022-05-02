<?php

namespace App\Http\Controllers;

use App\Models\Merito;
use App\Models\Persona;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Log;
use Illuminate\Support\Facades\Storage;

class MeritoController extends Controller
{
    public function meritos(Persona $persona, Merito $merito)
    {
        //dd($persona->id);
        $route = route('meritos.create',$persona->id);
        $page = 'meritos';



        return view('expedienteAvanzado.merito.table', compact('persona','route','page'));
    }

    public function nuevo_merito(Persona $persona, Merito $merito)
    {
        
        $route = route('meritos.store',$persona->id);
        $page = 'meritos';
       
        return view('expedienteAvanzado.merito.form', compact('merito','route', 'persona','page'));
    }

    public function store(Request $request, Persona $persona,  Merito $merito)
    {       
      $data=  Validator::make($request->all(), [
        'persona_id' => 'required',
        'merito_por_id' => 'required',
        'tipo_merito_id' => 'required',
        'folio_interno' => 'required',
        'fecha_reconocimiento' => 'required',
        'notas' => 'required',
            'acta_pdf' => ''
          
           
        ])->validate();

   

       

        $rutadecarpeta = $persona->fullname;

        //  dd($rutadecarpeta);

        if (request('acta_pdf')) 
        {
           

           
                if (empty($persona->meritos->acta_pdf)) 
                {

                        /*esta linea crea la ruta */
                        $pathseguro = $request->file('acta_pdf')->store
                        ('expedientes/' . $rutadecarpeta, 'public');

                        /**esta linea manda ek archivo a la carpeta*/
                        $acta_pdfmove = $request->acta_pdf->move(
                            public_path("{$pathseguro}"),
                            $request->acta_pdf->getClientOriginalExtension()
                        );

                        $array_acta_pdf = ['acta_pdf' => $pathseguro];

                } 
                 
                else {
                  
              
                        $path=public_path();
                        $completepath=($path.'/'.'storage/');
                        $oldpdfseguro=$persona->meritos->acta_pdf;
                    
                    
                        $imagePathseguronew = $request->file('acta_pdf')->store
                        ('expedientes/'.$rutadecarpeta,
                        'public');
                    
                        $acta_pdfmovenew = $request->acta_pdf->move
                        (public_path("{$imagePathseguronew}"),
                        $request->acta_pdf->getClientOriginalExtension());

                        unlink($completepath.$oldpdfseguro);

                        Storage::delete($completepath.$oldpdfseguro);

                        $array_acta_pdf = ['acta_pdf' => $imagePathseguronew];

                    }
                      
   
        }

        


        if (!isset($request->merito_id)){
            $registro = new Merito;
            $registro->create(array_merge($data, 
            $array_acta_pdf ?? []
        
        ));
        return redirect()->route('meritos',$request->persona_id)
        ->withSuccess("El merito se guardo éxitosamente");

        }

        else{
          
        $merito = Merito::find($request->merito_id);

    

        $merito->update(array_merge($data, $array_acta_pdf ?? []
        
        ));
    
    }
          
            /*y regresa con mensaje a la pagina anteriro*/

            return back()
                ->withSuccess("El merito se modifico éxitosamente");



    }


    public function edit(Merito $merito)
    {

        $fecha_reconocimiento= $merito->fecha_reconocimiento->toDateString();
       
        $persona=$merito->persona;
       // dd($persona);

        $route = route('meritos.store',$persona->id);
        $page = 'meritos';
       
        return view('expedienteAvanzado.merito.form', 
        compact('merito','route', 'persona','page','fecha_reconocimiento'));
    }

    public function destroy(Merito $merito)
    {
        $nombre = $merito->merito_por_id;
        $merito->delete();
        return redirect()->back()->withSucess("Se eliminó el merito de $nombre");
    }

    public function download($id, $tipo){
        
        // $media = Documento::findOrFail($id);
        $media = Merito::where('id', $id)->get($tipo)->first()->$tipo;

        // $t=TicketType::where('title', $request->get('type'))->first()->id;



        //  dd($media);
        // $disk = env('FILESYSTEM_DRIVER','public');
        return Storage::disk('public')->download($media);
    }











}
