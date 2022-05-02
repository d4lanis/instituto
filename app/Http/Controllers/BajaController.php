<?php

namespace App\Http\Controllers;

use App\Models\Baja;
use App\Models\Persona;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Storage;

class BajaController extends Controller
{
    public function bajas(Persona $persona, Baja $baja)
    {
        //dd($persona->id);
        $route = route('bajas.create',$persona->id);
        $page = 'bajas';
        return view('expedienteAvanzado.bajas.table', compact('persona','route','page'));
    }

    public function nuevo_baja(Persona $persona, Baja $baja)
    {
        
        $route = route('bajas.store',$persona->id);
        $page = 'bajas';
       
        return view('expedienteAvanzado.bajas.form', compact('baja','route', 'persona','page'));
    }

    public function store(Request $request, Persona $persona, Baja $baja)
    {       
      $data=  Validator::make($request->all(), [
            'persona_id' => 'required',
            'tipo_baja_id' => 'required',
            'motivo_baja_id' => 'required',
            'fecha_baja' => 'required',
          
            'acta_pdf' => ''
          
           
        ])->validate();

   

       

        $rutadecarpeta = $persona->fullname;

        //  dd($rutadecarpeta);

        if (request('acta_pdf')) 
        {
           

           
                if (empty($persona->bajas->acta_pdf)) 
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
                        $oldpdfseguro=$persona->bajas->acta_pdf;
                    
                    
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

        


        if (!isset($request->baja_id)){
            $registro = new Baja;
            $registro->create(array_merge($data, 
            $array_acta_pdf ?? []
        
        ));
        return redirect()->route('bajas',$request->persona_id)
        ->withSuccess("La baja se guardo éxitosamente");

        }

        else{
          
        $baja = Baja::find($request->baja_id);

    

        $baja->update(array_merge($data, $array_acta_pdf ?? []
        
        ));
    
    }
          
            /*y regresa con mensaje a la pagina anteriro*/

            return back()
                ->withSuccess("La baja se modifico éxitosamente");



    }


    public function edit(Baja $baja)
    {

        $fecha_baja= $baja->fecha_baja->toDateString();
       
        $persona=$baja->persona;
       // dd($persona);

        $route = route('bajas.store',$persona->id);
        $page = 'bajas';
       
        return view('expedienteAvanzado.bajas.form', 
        compact('baja','route', 'persona','page','fecha_baja'));
    }

    public function destroy(Baja $baja)
    {
        $nombre = $baja->motivo_baja_id;
        $baja->delete();
        return redirect()->back()->withSucess("Se eliminó la baja de $nombre");
    }



    public function download($id, $tipo){
        
        // dd($id , $tipo);
        // $media = Documento::findOrFail($id);
        $media = Baja::where('id', $id)->get($tipo)->first()->$tipo;

        // $t=TicketType::where('title', $request->get('type'))->first()->id;



        //  dd($media);
        // $disk = env('FILESYSTEM_DRIVER','public');
        return Storage::disk('public')->download($media);
    }

}
