<?php

use Illuminate\Database\Seeder;
use App\Models\Catalogo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatalogosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Catalogo::truncate();
        DB::statement("insert into catalogos (id,parent_id,name) select id,parent_id,name from poblaciones");

        $catalogos = [
            Catalogo::ESTADO_CIVIL,
            Catalogo::SEXO,
            Catalogo::ESCOLARIDAD,
            Catalogo::SI_NO,            
            Catalogo::TIPO_SANGRE,
            Catalogo::DIAS_SEMANA,
            Catalogo::TIPO_MATERIAS,
            Catalogo::CATEGORIA_MATERIAS,
            Catalogo::DELEGACIONES,
            Catalogo::CATEGORIA_PUESTOS,
            Catalogo::DOCUMENTOS,
            Catalogo::PRUEBA_CONFIANZA,
            Catalogo::COMPLEXION,
            Catalogo::COLOR_PIEL,
            Catalogo::CANTIDAD_CABELLO,
            Catalogo::COLOR_CABELLO,
            Catalogo::FORMA_CABELLO,
            Catalogo::COLOR_OJOS,
            Catalogo::SIZE_OJOS,
            Catalogo::SIZE_NARIZ,
            Catalogo::SIZE_BOCA,
            Catalogo::FORMA_CARA,
            Catalogo::NIVEL_ESCOLAR,
            Catalogo::ESTATUS_ESCOLAR,
            Catalogo::MERITO_POR,
            Catalogo::TIPO_MERITO,
            Catalogo::ORIGEN_QUEJA,
            Catalogo::TIPO_QUEJA,
            Catalogo::TIPO_SANCION,
            Catalogo::ESTADO_SANCION,
            Catalogo::PARENTESCO,
            Catalogo::TIPO_EVALUACION,
            Catalogo::FOTOGRAFIA,
            Catalogo::STATUS_PERSONAL,
            Catalogo::RESULTADO_DESEMPENO,
            Catalogo::CONTROL_CONFIANZA_RESULTADO,
            Catalogo::STATUS_DOCUMENTAL,
            Catalogo::RESULTADO_DOCUMENTAL,
            Catalogo::RESULTADO_ARMA,
            Catalogo::MOTIVO_CAMBIO,
            Catalogo::TIPO_BAJA,
            Catalogo::MOTIVO_BAJA,
            Catalogo::TIPO_ORGANO,
            Catalogo::EVALUACIONES,
            Catalogo::TIPO_CONTROL_CONFIANZA,
            Catalogo::MOTIVO_CONTROL_CONFIANZA,
 
            

            

           

        ];
        self::store_data($catalogos); 

        $items = [
            'Si',
            'No'
        ];
        self::store_data($items, Catalogo::SI_NO);

        $items = [
            'O Rh+',
            'O Rh-',
            'A Rh+',
            'A Rh-',
            'B Rh+',
            'B Rh-',
            'AB Rh+',
            'AB Rh-'
        ];
        self::store_data($items, Catalogo::TIPO_SANGRE);

        $items = [
            'Hombre',
            'Mujer'
        ];
        self::store_data($items, Catalogo::SEXO);

        $items = [
            'Soltero(a)',
            'Casado(a)',
            'Viudo(a)',
            'Union Libre',
            'Divorciado(a)'
        ];
        self::store_data($items, Catalogo::ESTADO_CIVIL);

        $items = [
            'sin estudios',
            'sabe leer y escribir',
            'primaria incompleta',
            'primaria completa',
            'secundaria incompleta',
            'secundaria completa',
            'bachillerato o preparatoria incompleta',
            'bachillerato o preparatoria completa',
            'profesional incompleto',
            'profesional completo',
            'posgrado incompleto',
            'posgrado completo'
        ];
        self::store_data($items, Catalogo::ESCOLARIDAD);

        $items = [
            'domingo',
            'lunes',
            'martes',
            'miercoles',
            'jueves',
            'viernes',
            'sábado'
        ];
        self::store_data($items, Catalogo::DIAS_SEMANA);

        $items = [
            'Formación Inicial - Ministerio Público',
            'Formación Inicial - Peritos',
            'Formación Inicial - Policía Investigadora',
            

        ];
        self::store_data($items, Catalogo::TIPO_MATERIAS);

        $items = [
            'Formación Básica Ministerio Público - Ético Profesional',
            'Formación Complementaria Policía Investigador - Complementarias',
            'Formación Básica Policía Investigador - Técnico Policial',
            'Formación Básica Policía Investigador - Investigación de los Delitos',
            'Formación Básica Policía Investigador - Sistema de Justicia Penal',
            'Formación Básica Policía Investigador - Jurídica',
            'Formación Básica Policía Investigador - Ético Profesional'
        ];
        self::store_data($items, Catalogo::CATEGORIA_MATERIAS);

        $items = [
            'Sureste',
            'Laguna I',
            'Centro',
            'Carbonífera',
            'Norte I',
            'Norte II',
            'Laguna II',
            'Oficinas centrales'
        ];
        self::store_data($items, Catalogo::DELEGACIONES);

        $items = [
            'Facilitadores penales',
            'Policias',
            'Peritos',
            'Ministerio publico',
            'Atenccion a victimas'
        ];
        self::store_data($items, Catalogo::CATEGORIA_PUESTOS);

        $categoria_padre = Catalogo::whereNull('parent_id')
                ->where('name',Catalogo::CATEGORIA_PUESTOS)->first();

        $items = [
            'policia primero',
            'policia segundo',
            'oficial',
            'Suboficial',
            'Inspector',
            'Subinspector',
            'Comisario general',
            'Inspector jefe',
            'Aspirante policia'
        ];
        $categoria_policia = Catalogo::where('parent_id',$categoria_padre->id)
                ->where('name','like','%Policias%')->first();

        self::store_data($items, $categoria_policia->id);


        $items = [
            'Ministerio Público',
            'Cordinadores de ministerio público',
            'Aspirante ministerio publico'
        ];

        $categoria_ministerio_publico = Catalogo::where('parent_id',$categoria_padre->id)
                ->where('name','like','%Ministerio publico%')->first();

        self::store_data($items, $categoria_ministerio_publico->id);


        $items = [
            'Facilitadores penales',
            'Cordinadores de facilitadores penales',
            'Aspirante facilitador penal'
        ];

        $categoria_facilitadores_penales = Catalogo::where('parent_id',$categoria_padre->id)
        ->where('name','like','%Facilitadores penales%')->first();

        self::store_data($items, $categoria_facilitadores_penales->id);


        $items = [
            'Perito psicologo',
            'Aspirante atencion a victimas'
        ];

        $categoria_atencion_a_victimas = Catalogo::where('parent_id',$categoria_padre->id)
        ->where('name','like','%Atenccion a victimas%')->first();


        self::store_data($items, $categoria_atencion_a_victimas->id);

        $items = [
            'Antropologos',
            'Arqueologos',
            'Medicos',
            'Quimicos',
            'Odontologos',
            'Contadores',
            'Psicologos',
            'Criminologos',
            'Aspitante perito',
            'Valuador',
            'Transito terrestre',
            'Topografo',
            'Criminalista de campo',
            'Documentologo',
            'Grafoscopico',
            'Balistico'
        ];

        $categoria_peritos = Catalogo::where('parent_id',$categoria_padre->id)
        ->where('name','like','%Peritos%')->first();

        self::store_data($items, $categoria_peritos->id);

        $items = [
            'Registro ante el Tribunal Superior de Justicia',
            'Constancia de no inhabilitación',
            'Hoja impresa del número del seguro social',
            'Cartilla liberada del servicio militar nacional',
            'Licencia de conducir vigente',
            'Credencial de elector',
            'Currículum vitae',
            'Carta de recomendación 1',
            'Carta de recomendación 2',
            'Carta de no antecedentes penales',
            'Comprobante de domicilio',
            'Título y cédula',
            'Certificado de bachillerato',
            '4 fotografías tamaño infantil a color',
            'CURP',
            'RFC con homoclave',
            'Acta de nacimiento',
            'Solicitud de empleo'
        ];
        self::store_data($items, Catalogo::DOCUMENTOS);

        $items = [
            'Aprobado',
            'Aprobado con restricciones',
            'No Aprobado',
            'No Asistió'
        ];
        self::store_data($items, Catalogo::PRUEBA_CONFIANZA);

        $items = [
            'Delgada',
            'Regular',
            'Robusta',
            'Atletica',
            'Obesa'
        ];
        self::store_data($items, Catalogo::COMPLEXION);

        $items = [
            'Albino',
            'Amarillo',
            'Moreno',
            'Negro',
            'Blanco',
            'Moreno claro',
            'Moreno oscuro',
            'Otro'
        ];
        self::store_data($items, Catalogo::COLOR_PIEL);

        $items = [
            'Abundante',
            'Escaso',
            'Regular',
            'Sin cabello'
           
        ];
        self::store_data($items, Catalogo::CANTIDAD_CABELLO);

        $items = [
            'Albino',
            'Entrecano',
            'Cano total',
            'Negro',
            'Castaño claro',
            'Castaño oscuro',
            'Pelirojo',
            'Rubio'
        ];
        self::store_data($items, Catalogo::COLOR_CABELLO);

        $items = [
            'Crespo',
            'Lacio',
            'Ondulado',
            'Rizado'
           
        ];
        self::store_data($items, Catalogo::FORMA_CABELLO);

        $items = [
            'Azul',
            'Gris',
            'Cafe claro',
            'Cafe oscuro',
            'Verde',
            'Otro'
           
        ];
        self::store_data($items, Catalogo::COLOR_OJOS);

        $items = [
            'Grandes',
            'Pequeños',
            'Regulares'
           
           
        ];
        self::store_data($items, Catalogo::SIZE_OJOS);


        $items = [
            'Grande',
            'Mediana',
            'Pequeña'
           
           
        ];
        self::store_data($items, Catalogo::SIZE_NARIZ);

        $items = [
            'Grande',
            'Mediana',
            'Pequeña'
           
           
        ];
        self::store_data($items, Catalogo::SIZE_BOCA);

        $items = [
            'Alargada',
            'Ovalada',
            'Cuadrada',
            'Redonda'
           
           
        ];
        self::store_data($items, Catalogo::FORMA_CARA);
        $items = [
            'Primaria',
            'Seundaria',
            'Bachillerato',
            'Tecnica',
            'Profesional',
            'Formacion inicial',
            'Formacion continua',
            'Especializacion'
           
           
        ];
        self::store_data($items, Catalogo::NIVEL_ESCOLAR);

        $items = [
            'En curso',
            'Finalizado',
            'Trunca'
           
           
        ];
        self::store_data($items, Catalogo::ESTATUS_ESCOLAR);


       


        $items = [
            'Queja1',
            'Queja2',
            'Queja3',
            'Queja4',
            'Queja5'
           
           
        ];
        self::store_data($items, Catalogo::ORIGEN_QUEJA);

        $items = [
            'Tipoqueja1',
            'Tipoqueja2',
            'Tipoqueja3',
            'Tipoqueja4',
            'Tipoqueja5'

        ];

        self::store_data($items, Catalogo::TIPO_QUEJA);

        $items = [
            'Multa',
            'Apercibimiento',
            'Exonerado',
            'Otro'
           
           
        ];
        self::store_data($items, Catalogo::TIPO_SANCION);

        $items = [
            'En curso',
            'Finzalizada'
           
        ];


        self::store_data($items, Catalogo::ESTADO_SANCION);

        $items = [
            'Consanguíneo',
            'Afinidad',
            'Sin parentesco'
        ];
        self::store_data($items, Catalogo::PARENTESCO);

        $items = [
            'Padre',
            'Madre',
            'Hijo(a)'
        ];


        self::store_data($items, 'Cosanguíneo');

       

        $items = [
            'Acondicionamiento fisico',
            'Armamento y tiro policial',
            'Conduccion de vehiculos y operacion de equipos de radiocomunicacion',
            'Uso de la fuerza y legítima defensa',
            'Investigación policial ',
            'Detención y conducción de personas ',
            'Sistema penal acusatorio',
            'Todas las anteriores'
           
        ];


        self::store_data($items, Catalogo::TIPO_EVALUACION);

        $items = [
            'Si',
            'No'
        ];


        self::store_data($items, Catalogo::FOTOGRAFIA);

        $items = [
            'Aspirante',
            'Nuevo ingreso (reingreso)',
            'Permanencia (Activo)',
            'Promocion (Activo)'


        ];


        self::store_data($items, Catalogo::STATUS_PERSONAL);
        $items = [
            'Aprobado',
            'No aprobado'

        ];


        self::store_data($items, Catalogo::RESULTADO_DESEMPENO);

        $items = [
            'Aprobado',
            'No aprobado',
            'No vigente'

        ];


        self::store_data($items, Catalogo::CONTROL_CONFIANZA_RESULTADO);

        $items = [
            'Activo',
            'Aspirante'

        ];


        self::store_data($items, Catalogo::STATUS_DOCUMENTAL);

        $items = [
            'Regular',
            'Irregular'

        ];


        self::store_data($items, Catalogo::RESULTADO_DOCUMENTAL);
        $items = [
            'Apto',
            'No apto'

        ];


        self::store_data($items, Catalogo::RESULTADO_ARMA);

        $items = [
            'Trayectoria',
            'Accion relevante',
            'Al merito',
            'Antiguedad en el servicio',
            'Iniciativas valiosas',
            'otro'

        ];


        self::store_data($items, Catalogo::MERITO_POR);

        $items = [
            'Reconocimiento',
            'Diploma',
            'Plaza',
            'Remuneracion economica'

        ];


        self::store_data($items, Catalogo::TIPO_MERITO);

        $items = [
            'Rotacion',
            'Reubicacion',
            'Solicitud personal'

        ];


        self::store_data($items, Catalogo::MOTIVO_CAMBIO);

        $items = [
            'Ordinaria',
            'Extraordinaria'

        ];


        self::store_data($items, Catalogo::TIPO_BAJA);
        $items = [
            'Muerte',
            'Renuncia',
            'Incapacidad permanente',
            'jubilacion',
            'Separacion del cargo',
            'Remocion del cargo'


        ];


        self::store_data($items, Catalogo::MOTIVO_BAJA);

        $items = [
            'Ordinaria',
            'Extraordinaria'

        ];

        
        self::store_data($items, Catalogo::TIPO_ORGANO);

        $items = [
            'Evaluacion del desempeño',
            'Evaluacion de competencias básicas'

        ];

        
        self::store_data($items, Catalogo::EVALUACIONES);


        $items = [
            'General',
            'Porte de arma'

        ];

        
        self::store_data($items, Catalogo::TIPO_CONTROL_CONFIANZA);


        $items = [
            'Permanencia',
            'Aspirante',
            'Porte de arma',
            'Promociones'


        ];

        
        self::store_data($items, Catalogo::MOTIVO_CONTROL_CONFIANZA);

        
        



    }

    function store_data($items, $catalogo_name = null, $delete = TRUE) {
        $parent_id = 0;
        if (is_numeric($catalogo_name)){
            $parent_id = $catalogo_name;
        } else {
            $catalogo = Catalogo::where('name','=',$catalogo_name)->first();
            $parent_id = is_null($catalogo) ? null : $catalogo->id ;     
        }

        if ($delete){
            Catalogo::where('parent_id','eq',$parent_id)->get()->each->delete();
        }

        $rows = [];
        //$id = 1;
        foreach ($items as $item) {
            $rows[] = [
                //'id' => $id,
                'parent_id' => $parent_id,
                'name' => utf8_encode(strtolower($item)),
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now()
            ];
            
            //$id = $id + 1;
        }
        //dd($rows);
        DB::table('catalogos')->insert( $rows );
    }
}
