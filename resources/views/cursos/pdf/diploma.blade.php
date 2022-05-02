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

<div class="fondo" >
    <img src="{{ public_path().'/images/fge_certificado2.jpg' }}" id="bg" alt="">
    <!-- <img src="{{ asset('images/fge_certificado2.jpg') }}" id="bg" alt=""> -->
</div>

<div class="header text-center">
    
      <p class="titulo">El centro de Profesionalización, Acreditación, Certificación y Carrera
      A través del Instituto de Estudios Penales y Formación profesional
      </p>
      <p class="titulo">Con autorización para certificar estudios mediante </p>
      <p class="titulo"> Decreto número 49 de fecha
      20 de junio de 1997</p>
     
      <p class="espacio titulo">Otorga el presente:</p>
      <br>
      <h1 class="display-4">DIPLOMA</h1>

      <h2 class="espacio mayusculas">A la C. {{$alumno->alumno->fullname}}</h2>
   <br>
      <h7 >Por haber concluido satisfactoriamente el:</h7>
      <br>
      <p class="espacio curso mayusculas">{{$curso->nombre}}</p>
    </div>
  
    <div class="footer text-center">
        <p class="fecha">Saltillo, Coahuila {{$fecha}}</p>

       <br>
       <br>
       <br>
       <div class="firma">
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
    <img src="data:image/png;base64, {{ $qrCode->setText($alumno->id)->generate() }} ">
    <!-- <img src="{{ public_path().'/images/barras.png' }}" > -->
    </div>
  
<div class="page-break"></div>
@endforeach

    </body>
</html>