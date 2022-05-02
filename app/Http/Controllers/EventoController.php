<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
   
    public function index()
    {
        $route = route('eventos.create');
        return view('eventos.table', compact('route'));
    }

  
    public function create()
    {
        $registro = new Evento;
        $route = route('eventos.store');
        $method = "post";
        $title = " Registro nuevo";
        return view('eventos.form', 
                compact('registro','title','route','method'));
    }

    
    public function store(Request $request, Evento $evento)
    {       
      $data=  Validator::make($request->all(), [
        'numero_oficio' => 'required',
        'titulo' => 'required',
        'fecha_evento' => 'required',
        'descripcion' => 'required',
            'oficio' => ''
          
           
        ])->validate();

   

       

        $rutadecarpeta = $request->numero_oficio;

        //  dd($rutadecarpeta);

        if (request('oficio')) 
        {
           

           
                if (empty($evento->oficio)) 
                {

                        /*esta linea crea la ruta */
                        $pathseguro = $request->file('oficio')->store
                        ('evento/' . $rutadecarpeta, 'public');

                        /**esta linea manda ek archivo a la carpeta*/
                        $oficiomove = $request->oficio->move(
                            public_path("{$pathseguro}"),
                            $request->oficio->getClientOriginalExtension()
                        );

                        $array_oficio = ['oficio' => $pathseguro];

                } 
                 
                else {
                  
              
                        $path=public_path();
                        $completepath=($path.'/'.'storage/');
                        $oldpdfseguro=$evento->numero_oficio;
                    
                    
                        $imagePathseguronew = $request->file('oficio')->store
                        ('evento/'.$rutadecarpeta,
                        'public');
                    
                        $oficiomovenew = $request->oficio->move
                        (public_path("{$imagePathseguronew}"),
                        $request->oficio->getClientOriginalExtension());

                        unlink($completepath.$oldpdfseguro);

                        Storage::delete($completepath.$oldpdfseguro);

                        $array_oficio = ['oficio' => $imagePathseguronew];

                    }
                      
   
        }

        


        if (!isset($request->evento_id)){
            $registro = new Evento;
            $registro->create(array_merge($data, 
            $array_oficio ?? []
        
        ));
        return redirect()->route('eventos.index')
        ->withSuccess("El evento se guardo éxitosamente");

        }

        else{
          
        $evento = Evento::find($request->evento_id);

    

        $evento->update(array_merge($data, $array_oficio ?? []
        
        ));
    
    }
          
            /*y regresa con mensaje a la pagina anteriro*/

            return back()
                ->withSuccess("El evento se modifico éxitosamente");



    }

   
    public function edit(Evento $evento)
    {
        $registro=$evento;
        $fecha_evento= $evento->fecha_evento->toDateString();
       
        $title=$evento->titulo;
       // dd($persona);

        $route = route('eventos.store',$evento->id);
        
       
        return view('eventos.form', 
        compact('registro','route','fecha_evento','title'));
    }

   
    public function destroy(Evento $evento)
    {
        $nombre = $evento->titulo;
        $evento->delete();
        return redirect()->back()->withSucess("Se eliminó el evento de $nombre");
    }

    public function download($id, $tipo){
        
        // $media = Documento::findOrFail($id);
        $media = Evento::where('id', $id)->get($tipo)->first()->$tipo;

        // $t=TicketType::where('title', $request->get('type'))->first()->id;



        //  dd($media);
        // $disk = env('FILESYSTEM_DRIVER','public');
        return Storage::disk('public')->download($media);
    }
}
