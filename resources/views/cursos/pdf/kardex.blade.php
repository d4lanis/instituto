<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate</title>

    <link href="{{ public_path().'/css/diploma.css' }}" rel="stylesheet">
    <style>


    </style>
</head>
<body>

@foreach($alumnos as $alumno)

<div class="xcontent">
<div class="logo_superior_kardex" >
    <div class="logo_kardex">
    <img src="{{ public_path().'/images/logos/fgj_small_2.png' }}"  alt="">
    <!-- <img src="{{ asset('images/fge_certificado2.jpg') }}" id="bg" alt=""> -->
    </div>
</div>
<div class="text-center-kardex">
    
      <p class="titulo_kardex">El centro de Profesionalización, Acreditación, Certificación y Carrera
        a través del Instituto de Estudios Penales y Formación Profesional con autorización para certificar
        estudios mediante Decreto número 49 de fecha
        20 de junio de 1997, hace constar que la C. A la C. <strong class="mayusculas"> {{$alumno[0]->nombre_alumno}} </strong>, cuya fotografia
        aparece al margen, curso el <strong class="mayusculas"> {{$alumno[0]->curso->nombre}}</strong>,
        efectuado del <strong class="mayusculas"> {{$alumno[0]->curso->fecha_inicio->format('j F Y')}}</strong> al 
        <strong class="mayusculas"> {{$alumno[0]->curso->fecha_termino->format('j F Y')}}</strong>, obteniendo las calificaciones que a
        continuacion se expresan:
      </p>

    </div>

    <div class="table_kardex">
    <table class="table table-striped" cellspacing="0" width="100%" 
            id="table_kardex" >
            <thead class="">
                    <tr style="  background-color: #f2f2f2; " >
                        <th >Materia</th>
                      
                        <th style=" text-align: center; ">Calificacion</th>
                      
                    </tr>
                </thead>
                @foreach($alumno as   $x)
                <tbody>
       <tr>
           <td style="width:85%">
 {{$x->salon_materia->materia->nombre}}
 </td>
 <td style="width:15%;  text-align: center;  ">
@if ($x->calificacion > 80 )
{{ $x->calificacion}}
@else

{{$x->extra}}Ex
@endif
</td>

</tr>    

@endforeach
<tr>
    <td style="font-weight:bold; ">Promedio General: </td>
    <td style="text-align: center;  ">{{round($alumno[0]->curso_alumno->promedio, 2)}}</td>
</tr>

     
</tbody>
</table>
<div class="minima">
<em >Escala de calificaciones del 10 al 100 minima aprobatoria 80 (ochenta)</em>
</div>
    </div>
    </div>
    <div class="footer_kardex text-center-footer">
        <p class="titulo_kardex_footer ">Se extiende la presente constancia que ampara 
        <strong class="mayusculas"> {{$horas}}</strong> horas clase impartidas, con
        validacion oficial de la Direccion General de Apoyo Tecnico de Secretariado Ejecutivo del Sistema
        Nacional de Seguridad Publica, mediante el oficio Num. <strong class="mayusculas"> {{$alumno[0]->curso->oficio_numero}}</strong> 
        de fecha <strong class="mayusculas"> {{$alumno[0]->curso->oficio_fecha->format('j F Y')}}</strong> </p>

        <p class="fecha_footer_kardex">Saltillo, Coahuila al {{$alumno[0]->curso->kardex_fecha->format('j F Y')}}</p>
       <br>
       <br>
       <br>
       <div class="firma_kardex">
      <p> _____________________________________________________________ </p>
        <p>Mtra. Maribel Araceli Rodríguez Ramírez</p>
        <p>Directora General del Centro de</p>
        <p>Profesionalización, Acreditación,</p>
        <p>Certificación y Carrera</p>

       </div>
    </div>
    <div class="codigo_barras text-center">
    


    <br>
    <br>
    
    <img src="data:image/png;base64, {{ $qrCode->setText($alumno[0]->curso_alumno_id)->generate() }} ">
    <!-- <img src="{{ public_path().'/images/barras.png' }}" > -->
    </div>
  
<div class="page-break"></div>
@endforeach

    </body>
</html>