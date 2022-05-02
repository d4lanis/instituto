<?php

namespace App\Http\Controllers;

use App\Models\Evento_evidencia;
use App\Models\Evento;
use Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class EventoEvidenciaController extends Controller
{
    public function evento_evidencia(Evento $evento)
    {
       
        $title = "Evidencia de evento";
        $route = route('evento_evidencia.store',$evento->id);
    // $images=Evidencia::where('evento_id',$evento->id)->paginate(2);
        return view('eventos.evidencia', compact('evento','route',
        'title'));
    }

    
    public function store(Request $request, Evento $evento)
    {


        // dd($request->all());
        $data=  Validator::make($request->all(), [
           
            'image' => 'required'
          
           
        ])->validate();

        $rutadecarpeta = $evento->numero_oficio;

        $images=$request->image;

        if (request('image')) 
        {
        foreach($images as $image){
              /*esta linea crea la ruta */
              $image_name = $image->getClientOriginalName();

            //   $pathseguro = $request->file('numero_seguro')->store
            //   ('expedientes/' . $rutadecarpeta, 'public');

             $image->storeAs('evento/'  .$rutadecarpeta  ,$image_name,   'public' );
              /**esta linea manda ek archivo a la carpeta*/
              $destino=public_path('evento/' . $rutadecarpeta);
              $image->move($destino, $image_name);

                $registro = new Evento_evidencia;
                $registro->evento_id = $evento->id;
                $registro->imagen = 'evento/' .$rutadecarpeta .'/'.$image_name;
                $registro->save();
                
        }
    }


    }

    public function download($id, $tipo){
        
        $media = Evento_evidencia::where('id', $id)->get($tipo)->first()->$tipo;
        return Storage::disk('public')->download($media);
    }


  
   
    public function destroy(Evento_evidencia $evento_evidencia,  $evento)
    {
       $imagen=Evento_evidencia::find($evento);
       $nombre=$imagen->imagen;
       $path=public_path();
       $completepath=($path.'/'.'storage/');
       $publicpath=($path.'/');

         //dd($path);
        unlink($completepath.$nombre);
        unlink($publicpath.$nombre);

        Storage::delete($completepath.$nombre);
        Storage::delete($publicpath.$nombre);
        
        $imagen->delete();

         return back()
            ->withSuccess("Se elimino éxitosamente");
    }
}
