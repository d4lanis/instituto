<?php

namespace App\Http\Controllers;

use App\Models\Evidencia;
use App\Models\Curso;
use Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class EvidenciaController extends Controller
{

    public function evidencia(Curso $curso)
    {

        $title = "Evidencia de curso";
        $route = route('evidencia.store', $curso->id);
        // $images=Evidencia::where('curso_id',$curso->id)->paginate(2);
        return view('cursos.evidencia', compact(
            'curso',
            'route',
            'title'
        ));
    }


    public function store(Request $request, Curso $curso)
    {


        // dd($request->all());
        $data =  Validator::make($request->all(), [

            'image' => 'required'


        ])->validate();

        $rutadecarpeta = $curso->oficio_numero;

        $images = $request->image;

        if (request('image')) {
            foreach ($images as $image) {
                /*esta linea crea la ruta */
                $image_name = $image->getClientOriginalName();

                //   $pathseguro = $request->file('numero_seguro')->store
                //   ('expedientes/' . $rutadecarpeta, 'public');

                $image->storeAs('curso/'  . $rutadecarpeta, $image_name,   'public');
                /**esta linea manda ek archivo a la carpeta*/
                $destino = public_path('curso/' . $rutadecarpeta);
                $image->move($destino, $image_name);

                $registro = new Evidencia;
                $registro->curso_id = $curso->id;
                $registro->imagen = 'curso/' . $rutadecarpeta . '/' . $image_name;
                $registro->save();
            }
        }
    }

    public function download($id, $tipo)
    {

        $media = Evidencia::where('id', $id)->get($tipo)->first()->$tipo;
        return Storage::disk('public')->download($media);
    }




    public function destroy(Evidencia $evidencia,  $curso)
    {
        $imagen = Evidencia::find($curso);
        $nombre = $imagen->imagen;
        $path = public_path();
        $completepath = ($path . '/' . 'storage/');
        $publicpath = ($path . '/');

        //dd($path);
        unlink($completepath . $nombre);
        unlink($publicpath . $nombre);

        Storage::delete($completepath . $nombre);
        Storage::delete($publicpath . $nombre);

        $imagen->delete();

        return back()
            ->withSuccess("Se elimino éxitosamente");
    }
}
