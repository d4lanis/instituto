<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:191|unique:users,id,' . $this->user()->id,
            'email' => 'required|email|max:191|unique:users,id,' . $this->user()->id,
            'nombre' => 'required|max:191',
            'paterno' => 'required|max:191',
            'materno' => 'required|max:191',
        ];
    }
}
