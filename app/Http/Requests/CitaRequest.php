<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Log;

class CitaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'fecha'=>'required',
            'hora'=>'required',
            'localidad_id'=>'required',
            'hechos'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'fecha.required' => 'La fecha es requerida',
            'hechos.required' => 'Hechos es requerido',
            'hora.required' => 'La hora es requerida',
            'delegacion.required' => 'Delegación es requerida'
        ];
    }
}
