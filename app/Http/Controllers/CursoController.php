<?php

namespace App\Http\Controllers;
use BarcodeGenerator;

use QrCode;
use Response;
use App\Models\Curso;
use App\Models\Materia;
use App\Models\PlanEstudio;
use App\Models\Catalogo;
use App\Models\Escolaridad;
use App\Models\SalonClase;
use App\Models\SalonClaseAlumno;
use App\Models\CursoAlumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use PDF;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route = route('cursos.create');
        return view('cursos.table', compact('route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $registro = new Curso;
       
       
        $route = route('cursos.store');
        $method = "post";
        $title = " Registro nuevo";
        return view('cursos.form', 
                compact('registro','title','route','method'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //dd($request);
         Validator::make($request->all(), [
           
            'nombre' => 'required',
            'descripcion' => 'required',
            'fecha_inicio' => 'required',
            'fecha_termino' => 'required',
            'oficio_numero' => 'required',
            'oficio_fecha' => 'required',
            'kardex_fecha' => 'required',
            'nivel_escolar_id' => 'required',
            'plan_estudio_id' => 'required',
            

           

        ])->validate();
    	
        $registro = new Curso;
        $registro->nombre = $request->nombre;
        $registro->descripcion = $request->descripcion;
        $registro->fecha_inicio = $request->fecha_inicio;
        $registro->fecha_termino = $request->fecha_termino;
        $registro->oficio_numero = $request->oficio_numero;
        $registro->oficio_fecha = $request->oficio_fecha;
        $registro->kardex_fecha = $request->kardex_fecha;
        $registro->nivel_escolar_id = $request->nivel_escolar_id;
        $registro->plan_estudio_id = $request->plan_estudio_id;
       
        $registro->save();

        //TO DO: insertar en la tabla SalonClase todas las materias del plande estudios seleccionado 

        foreach ($registro->planes->materias as $materia) {
            $materia_curso = new SalonClase;
            $materia_curso->curso_id = $registro->id;
            $materia_curso->materia_id = $materia->materia_id;
            $materia_curso->save();
        }

        return redirect()->route('cursos.index')
        ->withSuccess("El curso $request->nombre se guardo éxitosamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso)
    {
        
    //  $x=   PlanDeEstudios::where('id', $item)->firstOrFail();
    $fecha_inicio= $curso->fecha_inicio->toDateString();
    //$curso->fecha_inicio->format('Y-m-d');
    $fecha_termino= $curso->fecha_termino->toDateString();
    $oficio_fecha= $curso->oficio_fecha->toDateString();
    $kardex_fecha= $curso->kardex_fecha->toDateString();

    $name = $curso->nombre;

    //dd($name);

    $registro = $curso;
    $route = route('cursos.update',$curso->id);
    $method = "patch";
    $title = "$name  Edición registro (".$curso->id.")";

    return view('cursos.form', 
            compact('registro','title','route','method','name','fecha_termino',
        'fecha_inicio','oficio_fecha','kardex_fecha'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curso $curso)
    {
        Validator::make($request->all(), [
            'nombre' => 'required',
            'descripcion' => 'required',
            'fecha_inicio' => 'required',
            'fecha_termino' => 'required',
            'oficio_numero' => 'required',
            'oficio_fecha' => 'required',
            'kardex_fecha' => 'required',
            'plan_estudio_id' => 'required',
            'nivel_escolar_id' => 'required',
          
        ])->validate();

        $curso->update($request->only('nombre','descripcion','fecha_inicio','fecha_termino','oficio_numero','oficio_fecha',
    'kardex_fecha','plan_estudio_id','nivel_escolar_id'));
        return redirect()->route('cursos.index')
        ->withSuccess("El curso $request->nombre se modifico éxitosamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso $curso)
    {
        $nombre = $curso->nombre;

        //dd($nombre);
        
        $curso->delete();

         return redirect()->route('cursos.index')
            ->withSuccess("El curso con el nombre de $nombre se elimino éxitosamente");
    }

    public function planestudio()
    {
       			
        $planes =PlanEstudio::select('nombre as name', 'id')->get();
       
        foreach ($planes as $item) {
            $results[] = ["name" => $item->name, "id" => $item->id]; 
        }
      
            return response()->json([
                'status' => 'ok',
                'data' => $results
            ]);
        

    }


    public function cerrar_configuracion(Curso $curso)
    {
        //$salon = SalonClase::where('id', $curso->id);

        foreach ($curso->alumnos as $alumno) {
  
        foreach ($curso->salonClases as $salonClase) {
            $sca = new SalonClaseAlumno;
            $sca->curso_alumno_id = $alumno->id;
            $sca->salon_clase_id = $salonClase->id;
           
            $sca->save();
        }
         
       

       
        foreach ($curso->salonClases as $salonClase) {
            $status = Curso::find($curso->id);
            $status->status_id = 1;
            $status->status_curso = 0;
            $status->save();
            }

            //dd($curso->fecha_inicio->format('Y'));
            $registro = new Escolaridad;
            $registro->nombre_de_estudio = $curso->nombre;
            $registro->curso_id = $curso->id;
            $registro->nombre_de_institucion = 'Centro de Profesionalizacion';
            $registro->fecha_inicio = $curso->fecha_inicio->format('Y');
            $registro->fecha_conclusion = $curso->fecha_termino->format('Y');
            
            $estatus_escolar = Catalogo::where('name',Catalogo::ESTATUS_ESCOLAR)
                            ->whereNull('parent_id')
                            ->first()
                            ->items()
                            ->where('name','En curso')
                            ->first();

            // $nivel_escolar = Catalogo::where('name',Catalogo::NIVEL_ESCOLAR)
            //                 ->whereNull('parent_id')
            //                 ->first()
            //                 ->items()
            //                 ->where('name','::::::::')
            //                 ->first();

            $registro->estatus_id = $estatus_escolar->id;
            $registro->nivel_escolar_id = $curso->nivel_escolar_id;
            $registro->persona_id = $alumno->alumno->id;

            $registro->save();


          
        }

    
        
        return redirect()->route('cursos.index')
        ->withSuccess("El curso con el nombre de  se elimino éxitosamente");
    }

    public function cerrar_carga_maestros(Curso $curso)
    {       

       //dd( $curso->id);
       $maestros = SalonClase::where('curso_id', $curso->id)->get();
      
        foreach($maestros as $maestro){

           $maestro->status = 1;
           $maestro-> save();
        
        }
       

     
        return redirect()->route('cursos.index')
        ->withSuccess("Maestros asignados correctamente");
    }

    public function cerrar_curso(Curso $curso)
    {       
        $curso->status_curso = 1;
        $curso->save();
        
        foreach($curso->alumnos as $alumn)
        {
            
            $calificacion = SalonClaseAlumno::where('curso_alumno_id',$alumn->id)->get();
            
            $totalMaterias = count($calificacion);
            
            
            $totalCalification = 0;
            foreach($calificacion as $x){
                
                $nombre_de_campo = $x['calificacion'] >= 80 ? 'calificacion' : 'extra';
                $totalCalification += $x[ $nombre_de_campo ];
                $promedio = $totalCalification / $totalMaterias;
             
                //dd($promedio);
                $x = Escolaridad::where([['curso_id', $alumn->curso_id],[ 'persona_id',$alumn->persona_id ]])->get();
            foreach($x as $registro)
            {
            //   dd($x);
                $registro->promedio = $promedio; 
                $registro-> save();
            }

            $curso_promedio = CursoAlumno::where([['curso_id', $alumn->curso_id],[ 'persona_id',$alumn->persona_id ]])->get();
            foreach($curso_promedio as $registro)
            {
            //   dd($x);
                $registro->promedio = $promedio; 
                $registro-> save();
            }

            }

        }

        $x = Escolaridad::where('curso_id', $curso->id)->get();

        foreach($x as $registro)
        {
        //print_r($registro);
      
        $estatus_escolar = Catalogo::where('name',Catalogo::ESTATUS_ESCOLAR)
                            ->whereNull('parent_id')
                            ->first()
                            ->items()
                            ->where('name','Finalizado')
                            ->first();


            $registro->estatus_id = $estatus_escolar->id;
         
            $registro-> save();
                         
        }
       

        return redirect()->route('cursos.index')
                    ->withSuccess("Curso cerrado correctamente");
    }

    public function certificacion(Curso $curso)
    { 
        return view('cursos.pdf.table', compact('curso'));
    }

    public function diploma(Request $request)
    { 
        
        $curso_seleccionado=$request->curso_seleccionado;
        $curso = Curso::find($curso_seleccionado);
        $fecha=$curso->oficio_fecha->format('l jS \\of F Y');
        $alumno=$request->alumnos_asignados;
      
 
       $alumnos_ids =explode(",", $alumno);
       $alumnos = array();
       foreach($alumnos_ids as $alumno){

        $xx = CursoAlumno::find($alumno);
        $alumnos[] = $xx;

    //   dd($alumnos);
  
}

$qrCode = new QrCode();
$qrCode
   
    ->setSize(300)
    ->setPadding(10)
    ->setErrorCorrection('high')
    ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
    ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
    ->setLabel('Escanea el codigo Qr')
    ->setLabelFontSize(16)
    ->setImageType(QrCode::IMAGE_TYPE_PNG)
;



$data=compact('curso','fecha','alumnos','qrCode');
$pdf = PDF::loadView('cursos.pdf.diploma', $data , [], [
    'orientation' => 'L'
  ]);



 return  $pdf-> stream('invoice.pdf');



    //    return view('cursos.pdf.kardex', compact('curso','fecha','alumnos'));
    }
    public function kardex(Request $request)
    { 
        $curso_seleccionado=$request->curso_seleccionado;
        $salon = SalonClase::where('curso_id',$curso_seleccionado)->get('materia_id');
        $materias_id=$salon->toArray();
        $horas=0;
        foreach($materias_id as $materia){
            $duracion = Materia::where('id', $materia)->sum('duracion');
            $horas += $duracion;
        }
        
        
        $curso = Curso::find($curso_seleccionado);
 
        $alumno=$request->alumnos_asignados;
      
 
       $alumnos_ids =explode(",", $alumno);
       $alumnos = array();
      
       foreach($alumnos_ids as $alumno){
       
        $xx =SalonClaseAlumno::where('curso_alumno_id',$alumno)->get();

        $alumnos[] = $xx;
       
  
}

// foreach($alumnos as $alumno){
//     dd($alumno[0]->curso_alumno->promedio);
// }


$qrCode = new QrCode();
$qrCode
  
    ->setSize(300)
    ->setPadding(10)
    ->setErrorCorrection('high')
    ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
    ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
    ->setLabel('Escanea el codigo Qr')
    ->setLabelFontSize(16)
    ->setImageType(QrCode::IMAGE_TYPE_PNG)
;

$data=compact('curso','qrCode','alumnos','horas');
$pdf = PDF::loadView('cursos.pdf.kardex', $data);




 return  $pdf-> stream('invoice.pdf');
    //    return view('cursos.pdf.kardex', compact('curso','qrCode','alumnos'));
    }

}
