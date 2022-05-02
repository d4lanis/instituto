<?php

namespace App\Http\Controllers;

use App\Models\Sancion;
use App\Models\Persona;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Log;
use Illuminate\Support\Facades\Storage;

class SancionController extends Controller
{

    public function sanciones(Persona $persona, Sancion $sancion)
    {
       
        $page = 'sanciones';

    	$route = route('sanciones.create',$persona->id);
        return view('expedienteAvanzado.sanciones.table', compact('route','persona','page'));
    }

    public function nueva_sancion(Persona $persona, Sancion $sancion)
    {
        
       $fecha_inicio='';
       $fecha_termino='';
        $route = route('sanciones.store',$persona->id);
        $page = 'sanciones';
       
        return view('expedienteAvanzado.sanciones.form', compact('sancion','route', 'persona','page','fecha_inicio','fecha_termino'));
    }

  
    public function store(Request $request, Persona $persona, Sancion $sancion)
    {       
        $data= Validator::make($request->all(), [
            'persona_id' => 'required',
            'origen_queja_id' => 'required',
            'tipo_queja_id' => 'required',
            'folio_interno' => 'required',
            'asunto' => 'required',
            'tipo_sancion_id' => 'required',
            'estado_sancion_id' => 'required',
            'fecha_inicio' => 'required',
            'fecha_termino' => 'required',
            'notas' => 'required',
            'acta_pdf' => ''
           
        ])->validate();

        $rutadecarpeta = $persona->fullname;

        // dd($persona);

        if (request('acta_pdf')) 
        {
           

           
                if (empty($persona->sanciones->acta_pdf)) 
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
                        $oldpdfseguro=$persona->sanciones->acta_pdf;
                    
                    
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

        


        if (!isset($request->sancion_id)){
            $registro = new Sancion;
            $registro->create(array_merge($data, 
            $array_acta_pdf ?? []
        
        ));
        return redirect()->route('sanciones',$request->persona_id)
        ->withSuccess("La sancion se guardo éxitosamente");

        }

        else{
          
        $sancion = Sancion::find($request->sancion_id);

    

        $sancion->update(array_merge($data, $array_acta_pdf ?? []
        
        ));
    
    }
          
            /*y regresa con mensaje a la pagina anteriro*/

            return back()
                ->withSuccess("La sancion se modifico éxitosamente");


    }
 
    public function destroy(Sancion $sancion)
    {
        $nombre = $sancion->folio_interno;
        $sancion->delete();
        return redirect()->back()->withSucess("Se eliminó la sancion $nombre");
    }




    public function edit(Sancion $sancion)
    {

        $fecha_termino= $sancion->fecha_termino->toDateString();
       $fecha_inicio=  $sancion->fecha_inicio->toDateString();
        $persona=$sancion->persona;
       // dd($persona);

        $route = route('sanciones.store',$persona->id);
        $page = 'sanciones';
       
        return view('expedienteAvanzado.sanciones.form', compact('sancion','route', 'persona','page','fecha_inicio','fecha_termino'));
    }

    public function download($id, $tipo){
        
        // dd($id , $tipo);
        // $media = Documento::findOrFail($id);
        $media = Sancion::where('id', $id)->get($tipo)->first()->$tipo;

        // $t=TicketType::where('title', $request->get('type'))->first()->id;



        //  dd($media);
        // $disk = env('FILESYSTEM_DRIVER','public');
        return Storage::disk('public')->download($media);
    }

    
}
