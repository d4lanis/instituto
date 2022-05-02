<?php

namespace App\Http\Controllers;

use App\Models\Cambio;
use App\Models\Persona;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Storage;

class CambioController extends Controller
{
    public function cambios(Persona $persona, Cambio $cambio)
    {
        //dd($persona->id);
        $route = route('cambios.create',$persona->id);
        $page = 'cambios';
        return view('expedienteAvanzado.cambios.table', compact('persona','route','page'));
    }

    public function nuevo_cambio(Persona $persona, Cambio $cambio)
    {
        
        $route = route('cambios.store',$persona->id);
        $page = 'cambios';
       
        return view('expedienteAvanzado.cambios.form', compact('cambio','route', 'persona','page'));
    }

    public function store(Request $request, Persona $persona, Cambio $cambio)
    {       
      $data=  Validator::make($request->all(), [
            'persona_id' => 'required',
            'motivo_cambio_id' => 'required',
            'fecha_cambio' => 'required',
            'puesto_id' => '',
            'puesto_nuevo_id' => 'required',
            'acta_pdf' => ''
          
           
        ])->validate();

   

       

        $rutadecarpeta = $persona->fullname;

        //  dd($rutadecarpeta);

        if (request('acta_pdf')) 
        {
           

           
                if (empty($persona->cambios->acta_pdf)) 
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
                        $oldpdfseguro=$persona->cambios->acta_pdf;
                    
                    
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

        


        if (!isset($request->cambio_id)){
            $registro = new Cambio;
            $registro->create(array_merge($data, 
            $array_acta_pdf ?? []
        
        ));
        return redirect()->route('cambios',$request->persona_id)
        ->withSuccess("El cambio se guardo éxitosamente");

        }

        else{
          
        $cambio = Cambio::find($request->cambio_id);

    

        $cambio->update(array_merge($data, $array_acta_pdf ?? []
        
        ));
    
    }
          
            /*y regresa con mensaje a la pagina anteriro*/

            return back()
                ->withSuccess("El cambio se modifico éxitosamente");



    }


    public function edit(Cambio $cambio)
    {

        $fecha_cambio= $cambio->fecha_cambio->toDateString();
       
        $persona=$cambio->persona;
       // dd($persona);

        $route = route('cambios.store',$persona->id);
        $page = 'cambios';
       
        return view('expedienteAvanzado.cambios.form', 
        compact('cambio','route', 'persona','page','fecha_cambio'));
    }

    public function destroy(Cambio $cambio)
    {
        $nombre = $cambio->motivo_cambio_id;
        $cambio->delete();
        return redirect()->back()->withSucess("Se eliminó el cambio de $nombre");
    }

    public function download($id, $tipo){
        
        // dd($id , $tipo);
        // $media = Documento::findOrFail($id);
        $media = Cambio::where('id', $id)->get($tipo)->first()->$tipo;

        // $t=TicketType::where('title', $request->get('type'))->first()->id;



        //  dd($media);
        // $disk = env('FILESYSTEM_DRIVER','public');
        return Storage::disk('public')->download($media);
    }


}
