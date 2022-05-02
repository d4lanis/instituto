<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Persona;
use Illuminate\Http\Request;
use Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
  
    public function store(Request $request, Persona $persona)
    {

        $data = request()->validate( [
            'numero_seguro' => 'mimes:pdf|max:10000',
            'no_habilitacion' => 'mimes:pdf|max:10000',
            'solicitud_empleo' => 'mimes:pdf|max:10000',
            'acta_de_nacimiento' => 'mimes:pdf|max:10000',
            'rfc' => 'mimes:pdf|max:10000',
            'curp' => 'mimes:pdf|max:10000',
            'cer_secundaria' => 'mimes:pdf|max:10000',
            'cer_bachillerato' => 'mimes:pdf|max:10000',
            'cer_tecnico' => 'mimes:pdf|max:10000',
            'cer_profesional' => 'mimes:pdf|max:10000',
            'comentario' => '',
            'huellas' => 'image',
            'foto_perfil' => 'image',
            'persona_id' => 'required',


        ]);
    

        $rutadecarpeta = $persona->fullname;
        //dd($rutadecarpeta);

       


        /*aqui esta preguntando que si existe en algo en el input hidden de documento_id si existe algo en ese campo*/
        if (request('numero_seguro')) 
        {
           

           
                if (empty($persona->documento->numero_seguro)) 
                {

                        /*esta linea crea la ruta */
                        $pathseguro = $request->file('numero_seguro')->store
                        ('expedientes/' . $rutadecarpeta, 'public');

                        /**esta linea manda ek archivo a la carpeta*/
                        $numero_seguromove = $request->numero_seguro->move(
                            public_path("{$pathseguro}"),
                            $request->numero_seguro->getClientOriginalExtension()
                        );

                        $array_numero_seguro = ['numero_seguro' => $pathseguro];

                } 
                 
                else {
                  
              
                        $path=public_path();
                        $completepath=($path.'/'.'storage/');
                        $oldpdfseguro=$persona->documento->numero_seguro;
                    
                    
                        $imagePathseguronew = $request->file('numero_seguro')->store
                        ('expedientes/'.$rutadecarpeta,
                        'public');
                    
                        $numero_seguromovenew = $request->numero_seguro->move
                        (public_path("{$imagePathseguronew}"),
                        $request->numero_seguro->getClientOriginalExtension());

                        unlink($completepath.$oldpdfseguro);

                        Storage::delete($completepath.$oldpdfseguro);

                        $array_numero_seguro = ['numero_seguro' => $imagePathseguronew];

                    }
                      
   
        }
          


           /*aqui esta preguntando que si existe en algo en el input hidden de documento_id si existe algo en ese campo*/
           if (request('no_habilitacion')) 
                {
           

           
                    if (empty($persona->documento->no_habilitacion)) 
                    
                    {

                        /*esta linea crea la ruta */
                        $pathno = $request->file('no_habilitacion')->store('expedientes/' . $rutadecarpeta, 'public');

                        /**esta linea manda ek archivo a la carpeta*/
                        $no_habilitacionmove = $request->no_habilitacion->move(
                            public_path("{$pathno}"),
                            $request->no_habilitacion->getClientOriginalExtension()
                        );

                        $array_no_habilitacion = ['no_habilitacion' => $pathno];

                    } 
                    
                    else {
                    
                
                    $path=public_path();
                    $completepath=($path.'/'.'storage/');
                    $oldpdfno=$persona->documento->no_habilitacion;
                
                
                    $Pathnonew = $request->file('no_habilitacion')->store('expedientes/'.$rutadecarpeta,
                    'public');
                
                    $no_habilitacionmovenew = $request->no_habilitacion->move(public_path("{$Pathnonew}"),
                    $request->no_habilitacion->getClientOriginalExtension());

                    unlink($completepath.$oldpdfno);

                    Storage::delete($completepath.$oldpdfno);

                    $array_no_habilitacion = ['no_habilitacion' => $Pathnonew];

                        }
                  

                }

        

                if (request('solicitud_empleo')) 
                {
           

           
                    if (empty($persona->documento->solicitud_empleo)) 
                    
                    {

                        /*esta linea crea la ruta */
                        $pathno = $request->file('solicitud_empleo')->store('expedientes/' . $rutadecarpeta, 'public');

                        /**esta linea manda ek archivo a la carpeta*/
                        $solicitud_empleomove = $request->solicitud_empleo->move(
                            public_path("{$pathno}"),
                            $request->solicitud_empleo->getClientOriginalExtension()
                        );

                        $array_solicitud_empleo = ['solicitud_empleo' => $pathno];

                    } 
                    
                    else {
                    
                
                    $path=public_path();
                    $completepath=($path.'/'.'storage/');
                    $oldpdfno=$persona->documento->solicitud_empleo;
                
                
                    $Pathnonew = $request->file('solicitud_empleo')->store('expedientes/'.$rutadecarpeta,
                    'public');
                
                    $solicitud_empleomovenew = $request->solicitud_empleo->move(public_path("{$Pathnonew}"),
                    $request->solicitud_empleo->getClientOriginalExtension());

                    unlink($completepath.$oldpdfno);

                    Storage::delete($completepath.$oldpdfno);

                    $array_solicitud_empleo = ['solicitud_empleo' => $Pathnonew];

                        }
                  

                }


                if (request('acta_de_nacimiento')) 
                {
           

           
                    if (empty($persona->documento->acta_de_nacimiento)) 
                    
                    {

                        /*esta linea crea la ruta */
                        $pathno = $request->file('acta_de_nacimiento')->store('expedientes/' . $rutadecarpeta, 'public');

                        /**esta linea manda ek archivo a la carpeta*/
                        $acta_de_nacimientomove = $request->acta_de_nacimiento->move(
                            public_path("{$pathno}"),
                            $request->acta_de_nacimiento->getClientOriginalExtension()
                        );

                        $array_acta_de_nacimiento = ['acta_de_nacimiento' => $pathno];

                    } 
                    
                    else {
                    
                
                    $path=public_path();
                    $completepath=($path.'/'.'storage/');
                    $oldpdfno=$persona->documento->acta_de_nacimiento;
                
                
                    $Pathnonew = $request->file('acta_de_nacimiento')->store('expedientes/'.$rutadecarpeta,
                    'public');
                
                    $acta_de_nacimientomovenew = $request->acta_de_nacimiento->move(public_path("{$Pathnonew}"),
                    $request->acta_de_nacimiento->getClientOriginalExtension());

                    unlink($completepath.$oldpdfno);

                    Storage::delete($completepath.$oldpdfno);

                    $array_acta_de_nacimiento = ['acta_de_nacimiento' => $Pathnonew];

                        }
                  

                }

                if (request('rfc')) 
                {
           

           
                    if (empty($persona->documento->rfc)) 
                    
                    {

                        /*esta linea crea la ruta */
                        $pathno = $request->file('rfc')->store('expedientes/' . $rutadecarpeta, 'public');

                        /**esta linea manda ek archivo a la carpeta*/
                        $rfcmove = $request->rfc->move(
                            public_path("{$pathno}"),
                            $request->rfc->getClientOriginalExtension()
                        );

                        $array_rfc = ['rfc' => $pathno];

                    } 
                    
                    else {
                    
                
                    $path=public_path();
                    $completepath=($path.'/'.'storage/');
                    $oldpdfno=$persona->documento->rfc;
                
                
                    $Pathnonew = $request->file('rfc')->store('expedientes/'.$rutadecarpeta,
                    'public');
                
                    $rfcmovenew = $request->rfc->move(public_path("{$Pathnonew}"),
                    $request->rfc->getClientOriginalExtension());

                    unlink($completepath.$oldpdfno);

                    Storage::delete($completepath.$oldpdfno);

                    $array_rfc = ['rfc' => $Pathnonew];

                        }
                  

                }

                if (request('curp')) 
                {
           

           
                    if (empty($persona->documento->curp)) 
                    
                    {

                        /*esta linea crea la ruta */
                        $pathno = $request->file('curp')->store('expedientes/' . $rutadecarpeta, 'public');

                        /**esta linea manda ek archivo a la carpeta*/
                        $curpmove = $request->curp->move(
                            public_path("{$pathno}"),
                            $request->curp->getClientOriginalExtension()
                        );

                        $array_curp = ['curp' => $pathno];

                    } 
                    
                    else {
                    
                
                    $path=public_path();
                    $completepath=($path.'/'.'storage/');
                    $oldpdfno=$persona->documento->curp;
                
                
                    $Pathnonew = $request->file('curp')->store('expedientes/'.$rutadecarpeta,
                    'public');
                
                    $curpmovenew = $request->curp->move(public_path("{$Pathnonew}"),
                    $request->curp->getClientOriginalExtension());

                    unlink($completepath.$oldpdfno);

                    Storage::delete($completepath.$oldpdfno);

                    $array_curp = ['curp' => $Pathnonew];

                        }
                  

                }

                if (request('cer_secundaria')) 
                {
           

           
                    if (empty($persona->documento->cer_secundaria)) 
                    
                    {

                        /*esta linea crea la ruta */
                        $pathno = $request->file('cer_secundaria')->store('expedientes/' . $rutadecarpeta, 'public');

                        /**esta linea manda ek archivo a la carpeta*/
                        $cer_secundariamove = $request->cer_secundaria->move(
                            public_path("{$pathno}"),
                            $request->cer_secundaria->getClientOriginalExtension()
                        );

                        $array_cer_secundaria = ['cer_secundaria' => $pathno];

                    } 
                    
                    else {
                    
                
                    $path=public_path();
                    $completepath=($path.'/'.'storage/');
                    $oldpdfno=$persona->documento->cer_secundaria;
                
                
                    $Pathnonew = $request->file('cer_secundaria')->store('expedientes/'.$rutadecarpeta,
                    'public');
                
                    $cer_secundariamovenew = $request->cer_secundaria->move(public_path("{$Pathnonew}"),
                    $request->cer_secundaria->getClientOriginalExtension());

                    unlink($completepath.$oldpdfno);

                    Storage::delete($completepath.$oldpdfno);

                    $array_cer_secundaria = ['cer_secundaria' => $Pathnonew];

                        }
                  

                }



                if (request('cer_bachillerato')) 
                {
           

           
                    if (empty($persona->documento->cer_bachillerato)) 
                    
                    {

                        /*esta linea crea la ruta */
                        $pathno = $request->file('cer_bachillerato')->store('expedientes/' . $rutadecarpeta, 'public');

                        /**esta linea manda ek archivo a la carpeta*/
                        $cer_bachilleratomove = $request->cer_bachillerato->move(
                            public_path("{$pathno}"),
                            $request->cer_bachillerato->getClientOriginalExtension()
                        );

                        $array_cer_bachillerato = ['cer_bachillerato' => $pathno];

                    } 
                    
                    else {
                    
                
                    $path=public_path();
                    $completepath=($path.'/'.'storage/');
                    $oldpdfno=$persona->documento->cer_bachillerato;
                
                
                    $Pathnonew = $request->file('cer_bachillerato')->store('expedientes/'.$rutadecarpeta,
                    'public');
                
                    $cer_bachilleratomovenew = $request->cer_bachillerato->move(public_path("{$Pathnonew}"),
                    $request->cer_bachillerato->getClientOriginalExtension());

                    unlink($completepath.$oldpdfno);

                    Storage::delete($completepath.$oldpdfno);

                    $array_cer_bachillerato = ['cer_bachillerato' => $Pathnonew];

                        }
                  

                }

                if (request('cer_tecnico')) 
                {
           

           
                    if (empty($persona->documento->cer_tecnico)) 
                    
                    {

                        /*esta linea crea la ruta */
                        $pathno = $request->file('cer_tecnico')->store('expedientes/' . $rutadecarpeta, 'public');

                        /**esta linea manda ek archivo a la carpeta*/
                        $cer_tecnicomove = $request->cer_tecnico->move(
                            public_path("{$pathno}"),
                            $request->cer_tecnico->getClientOriginalExtension()
                        );

                        $array_cer_tecnico = ['cer_tecnico' => $pathno];

                    } 
                    
                    else {
                    
                
                    $path=public_path();
                    $completepath=($path.'/'.'storage/');
                    $oldpdfno=$persona->documento->cer_tecnico;
                
                
                    $Pathnonew = $request->file('cer_tecnico')->store('expedientes/'.$rutadecarpeta,
                    'public');
                
                    $cer_tecnicomovenew = $request->cer_tecnico->move(public_path("{$Pathnonew}"),
                    $request->cer_tecnico->getClientOriginalExtension());

                    unlink($completepath.$oldpdfno);

                    Storage::delete($completepath.$oldpdfno);

                    $array_cer_tecnico = ['cer_tecnico' => $Pathnonew];

                        }
                  

                }

                if (request('cer_profesional')) 
                {
           

           
                    if (empty($persona->documento->cer_profesional)) 
                    
                    {

                        /*esta linea crea la ruta */
                        $pathno = $request->file('cer_profesional')->store('expedientes/' . $rutadecarpeta, 'public');

                        /**esta linea manda ek archivo a la carpeta*/
                        $cer_profesionalmove = $request->cer_profesional->move(
                            public_path("{$pathno}"),
                            $request->cer_profesional->getClientOriginalExtension()
                        );

                        $array_cer_profesional = ['cer_profesional' => $pathno];

                    } 
                    
                    else {
                    
                
                    $path=public_path();
                    $completepath=($path.'/'.'storage/');
                    $oldpdfno=$persona->documento->cer_profesional;
                
                
                    $Pathnonew = $request->file('cer_profesional')->store('expedientes/'.$rutadecarpeta,
                    'public');
                
                    $cer_profesionalmovenew = $request->cer_profesional->move(public_path("{$Pathnonew}"),
                    $request->cer_profesional->getClientOriginalExtension());

                    unlink($completepath.$oldpdfno);

                    Storage::delete($completepath.$oldpdfno);

                    $array_cer_profesional = ['cer_profesional' => $Pathnonew];

                        }
                  

                }

                if (request('foto_perfil')) 
                {
           

           
                    if (empty($persona->documento->foto_perfil)) 
                    
                    {

                        /*esta linea crea la ruta */
                        $pathno = $request->file('foto_perfil')->store('expedientes/' . $rutadecarpeta, 'public');

                        /**esta linea manda ek archivo a la carpeta*/
                        $foto_perfilmove = $request->foto_perfil->move(
                            public_path("{$pathno}"),
                            $request->foto_perfil->getClientOriginalExtension()
                        );

                        $array_foto_perfil = ['foto_perfil' => $pathno];

                    } 
                    
                    else {
                    
                
                    $path=public_path();
                    $completepath=($path.'/'.'storage/');
                    $oldpdfno=$persona->documento->foto_perfil;
                
                
                    $Pathnonew = $request->file('foto_perfil')->store('expedientes/'.$rutadecarpeta,
                    'public');
                
                    $foto_perfilmovenew = $request->foto_perfil->move(public_path("{$Pathnonew}"),
                    $request->foto_perfil->getClientOriginalExtension());

                    unlink($completepath.$oldpdfno);

                    Storage::delete($completepath.$oldpdfno);

                    $array_foto_perfil = ['foto_perfil' => $Pathnonew];

                        }
                  

                }

                if (request('huellas')) 
                {
           

           
                    if (empty($persona->documento->huellas)) 
                    
                    {

                        /*esta linea crea la ruta */
                        $pathno = $request->file('huellas')->store('expedientes/' . $rutadecarpeta, 'public');

                        /**esta linea manda ek archivo a la carpeta*/
                        $huellasmove = $request->huellas->move(
                            public_path("{$pathno}"),
                            $request->huellas->getClientOriginalExtension()
                        );

                        $array_huellas = ['huellas' => $pathno];

                    } 
                    
                    else {
                    
                
                    $path=public_path();
                    $completepath=($path.'/'.'storage/');
                    $oldpdfno=$persona->documento->huellas;
                
                
                    $Pathnonew = $request->file('huellas')->store('expedientes/'.$rutadecarpeta,
                    'public');
                
                    $huellasmovenew = $request->huellas->move(public_path("{$Pathnonew}"),
                    $request->huellas->getClientOriginalExtension());

                    unlink($completepath.$oldpdfno);

                    Storage::delete($completepath.$oldpdfno);

                    $array_huellas = ['huellas' => $Pathnonew];

                        }
                  

                }


    	if (!isset($request->documento_id)){
            $documento = new Documento;
            $documento->create(array_merge($data, 
            $array_numero_seguro ?? [],
            $array_no_habilitacion ?? [],
            $array_solicitud_empleo ?? [],
            $array_acta_de_nacimiento ?? [],
            $array_rfc ?? [],
            $array_curp ?? [],
            $array_cer_secundaria ?? [],
            $array_cer_bachillerato ?? [],
            $array_cer_tecnico ?? [],
            $array_cer_profesional ?? [],
            $array_foto_perfil ?? [],
            $array_huellas ?? []
        
        ));
            return back()
            ->withSuccess("El elemento  se guardo éxitosamente");

        }

        else{
          
        $documento = Documento::find($request->documento_id);

    

        $documento->update(array_merge($data, $array_numero_seguro ?? [],
            $array_no_habilitacion ?? [],
            $array_solicitud_empleo ?? [],
            $array_acta_de_nacimiento ?? [],
            $array_rfc ?? [],
            $array_curp ?? [],
            $array_cer_secundaria ?? [],
            $array_cer_bachillerato ?? [],
            $array_cer_tecnico ?? [],
            $array_cer_profesional ?? [],
            $array_foto_perfil ?? [],
            $array_huellas ?? []
        
        ));
    
    }
          
            /*y regresa con mensaje a la pagina anteriro*/

            return back()
                ->withSuccess("El elemento  se modifico éxitosamente");
        
       
      





    }

  
  
    public function destroy(Documento $documento)
    {
        //
    }

    public function documentos(Persona $persona)
    {
        $route = route('documentos.store',$persona->id);
        $page = 'documentos';
        return view('expedientes.documentos.form', compact('persona','route','page'));
    }


    public function download($id, $tipo){
        
        // $media = Documento::findOrFail($id);
        $media = Documento::where('persona_id', $id)->get($tipo)->first()->$tipo;

        // $t=TicketType::where('title', $request->get('type'))->first()->id;



        //  dd($media);
        // $disk = env('FILESYSTEM_DRIVER','public');
        return Storage::disk('public')->download($media);
    }
}
