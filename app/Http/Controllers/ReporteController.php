<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\Persona;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function general()
    {

        $nuevo_renglon = [
            'hombre' => 0, 'mujer' => 0, 'total' => 0
        ];
        $report = [];
        $report['header'] = ['Mes', 'Hombres', 'Mujeres', 'Total'];
        $report['footer'] = $nuevo_renglon;

        Persona::get()->each(function ($item) use (&$report, $nuevo_renglon) {
            // dd($item);
            $sexo = $item->sexo->name;
            $mes = $item->fecha_ingreso->format('Y-M');

            if (!isset($report['data'][$mes])) {
                $report['data'][$mes] = $nuevo_renglon;
            }

            $report['data'][$mes][$sexo] += 1;
            $report['data'][$mes]['total'] += 1;

            $report['footer'][$sexo] += 1;
            $report['footer']['total'] += 1;
        });

        $page = 'general';
        return view('reportes.table_general', compact('report', 'page'));

        // return view('reportes.index', compact('report'));   //
    }

    public function aprobados()
    {

        $nuevo_renglon = [
            'total' => 0
        ];
        $x1['hombre'] = [
            'aprobado' => 0, 'no aprobado' => 0, 'sin clasificar' => 0
        ];
        $x2['mujer'] = [
            'aprobado' => 0, 'no aprobado' => 0, 'sin clasificar' => 0
        ];

        $estado = $x1 + $x2 + $nuevo_renglon;
        $report = [];
        $report['header'] = [
            'Mes', 'Hombres Aprobados ', 'Hombres No Aprobados ',  'Hombres Sin clasificar ',
            'Mujeres Aprobadas', 'Mujeres No Aprobadas', 'Mujeres Sin clasificar ', 'Total'
        ];
        $report['footer'] =  $estado;

        Persona::get()->each(function ($item) use (&$report,  $estado) {
            // dd($item);

            $verificacion = $item->control->last();
            if ($verificacion  != null) {
                $status = $verificacion->resultado->name;
            } else {
                $status = 'sin clasificar';
            }
            $sexo = $item->sexo->name;
            $mes = $item->fecha_ingreso->format('Y-M');

            // dd($item->sexo);

            if (!isset($report['data'][$mes])) {
                $report['data'][$mes] = $estado;
            }


            $report['data'][$mes][$sexo][$status] += 1;
            $report['data'][$mes]['total'] += 1;

            $report['footer'][$sexo][$status] += 1;
            $report['footer']['total'] += 1;
        });


        $page = 'aprobados';
        return view('reportes.table_aprobados', compact('report', 'page'));

        // return view('reportes.index', compact('report'));   //
    }
}
