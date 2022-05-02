<?php

namespace App\Http\Controllers;

use App\Models\Colegiado;
use Illuminate\Http\Request;
use Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ColegiadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route = route('colegiados.create');
        return view('colegiados.table', compact('route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $registro = new Colegiado;
        $route = route('colegiados.store');
        $method = "post";
        $title = " Registro nuevo";
        return view('colegiados.form', 
                compact('registro','title','route','method'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Colegiado $colegiado)
    {
        //dd($request->all());
       $data = Validator::make($request->all(), [
           
            'numero_oficio' => 'required',
            'fecha_solicitud' => 'required',
            'motivo' => 'required',
            'solicitud' => '',
            'respuesta' => '',
            'notas' => '',
            'resultado' => ''
          
        ])->validate();


        $rutadecarpeta = $request->numero_oficio;

        //  dd($rutadecarpeta);

        if (request('solicitud')) 
        {
           

           
                if (empty($colegiado->solicitud)) 
                {

                        /*esta linea crea la ruta */
                        $pathseguro = $request->file('solicitud')->store
                        ('colegiado_archivos/' . $rutadecarpeta, 'public');

                        /**esta linea manda ek archivo a la carpeta*/
                        $solicitudmove = $request->solicitud->move(
                            public_path("{$pathseguro}"),
                            $request->solicitud->getClientOriginalExtension()
                        );

                        $array_solicitud = ['solicitud' => $pathseguro];

                } 
                 
                else {
                  
              
                        $path=public_path();
                        $completepath=($path.'/'.'storage/');
                        $oldpdfseguro=$colegiado->solicitud;
                    
                    
                        $imagePathseguronew = $request->file('solicitud')->store
                        ('colegiado_archivos/'.$rutadecarpeta,
                        'public');
                    
                        $solicitudmovenew = $request->solicitud->move
                        (public_path("{$imagePathseguronew}"),
                        $request->solicitud->getClientOriginalExtension());

                        unlink($completepath.$oldpdfseguro);

                        Storage::delete($completepath.$oldpdfseguro);

                        $array_solicitud = ['solicitud' => $imagePathseguronew];

                    }
                      
   
        }

        if (request('respuesta')) 
        {
           

           
                if (empty($colegiado->respuesta)) 
                {

                        /*esta linea crea la ruta */
                        $pathseguro = $request->file('respuesta')->store
                        ('colegiado_archivos/' . $rutadecarpeta, 'public');

                        /**esta linea manda ek archivo a la carpeta*/
                        $respuestamove = $request->respuesta->move(
                            public_path("{$pathseguro}"),
                            $request->respuesta->getClientOriginalExtension()
                        );

                        

                        $array_respuesta = ['respuesta' => $pathseguro];

                } 
                 
                else {
                   
              
                        $path=public_path();
                        $completepath=($path.'/'.'storage/');
                        $oldpdfrespuesta=$colegiado->respuesta;
                    
                    
                        $imagePathrespuestanew = $request->file('respuesta')->store
                        ('colegiado_archivos/'.$rutadecarpeta,
                        'public');
                    
                        $respuestamovenew = $request->respuesta->move
                        (public_path("{$imagePathrespuestanew}"),
                        $request->respuesta->getClientOriginalExtension());

                     

                        unlink($completepath.$oldpdfrespuesta);

                        Storage::delete($completepath.$oldpdfrespuesta);

                        $array_respuesta = ['respuesta' => $imagePathrespuestanew];

                    }
                      
   
        }

        if (request('resultado')) 
        {
           

           
                if (empty($colegiado->resultado)) 
                {

                        /*esta linea crea la ruta */
                        $pathseguro = $request->file('resultado')->store
                        ('colegiado_archivos/' . $rutadecarpeta, 'public');

                        /**esta linea manda ek archivo a la carpeta*/
                        $resultadomove = $request->resultado->move(
                            public_path("{$pathseguro}"),
                            $request->resultado->getClientOriginalExtension()
                        );

                        

                        $array_resultado = ['resultado' => $pathseguro];

                } 
                 
                else {
                   
              
                        $path=public_path();
                        $completepath=($path.'/'.'storage/');
                        $oldpdfresultado=$colegiado->resultado;
                    
                    
                        $imagePathresultadonew = $request->file('resultado')->store
                        ('colegiado_archivos/'.$rutadecarpeta,
                        'public');
                    
                        $resultadomovenew = $request->resultado->move
                        (public_path("{$imagePathresultadonew}"),
                        $request->resultado->getClientOriginalExtension());

                     

                        unlink($completepath.$oldpdfresultado);

                        Storage::delete($completepath.$oldpdfresultado);

                        $array_resultado = ['resultado' => $imagePathresultadonew];

                    }
                      
   
        }

        


        if (!isset($request->colegiado_id)){
            $colegiado = new Colegiado;
            $colegiado->create(array_merge($data, 
            $array_solicitud ?? [],
            $array_respuesta ?? [],
            $array_resultado?? []

        
        ));
        return redirect()->route('colegiados.index',$request->colegiado_id)
        ->withSuccess("El colegiado se guardo éxitosamente");

        }

        else{
          
        $colegiado = Colegiado::find($request->colegiado_id);

    

        $colegiado->update(array_merge($data, $array_solicitud ?? [],
        $array_respuesta ?? [], $array_resultado ?? []
        
        ));
    
    }
          
            /*y regresa con mensaje a la pagina anteriro*/

            return back()
                ->withSuccess("El colegiado se modifico éxitosamente");


    	
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Colegiado  $colegiado
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Colegiado  $colegiado
     * @return \Illuminate\Http\Response
     */
  

    public function edit(Colegiado $colegiado)
    {

        $name = $colegiado->numero_oficio;
       
        $registro = $colegiado;
       // dd($persona);

        $route = route('colegiados.store',$colegiado->id);
        $title = "Edición del oficio: $name";
        
       
        return view('colegiados.form', 
        compact('registro','title','route','name'));
    }

  
    public function destroy(Colegiado $colegiado)
    {
        $nombre = $colegiado->numero_oficio;
        
        $colegiado->delete();

         return redirect()->route('colegiados.index')
            ->withSuccess("El oficio se elimino éxitosamente");
    }


    public function download($id, $tipo){
        
        // $media = Documento::findOrFail($id);
        $media = Colegiado::where('id', $id)->get($tipo)->first()->$tipo;

        // $t=TicketType::where('title', $request->get('type'))->first()->id;



        //  dd($media);
        // $disk = env('FILESYSTEM_DRIVER','public');
        return Storage::disk('public')->download($media);
    }
}
