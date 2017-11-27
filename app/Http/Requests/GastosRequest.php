<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GastosRequest extends FormRequest
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
           'gasto' => 'required|max:255',
           'tipo' => 'required|max:255'

         ];
     }

     public function messages()
     {
         return [
           'gasto.required' => 'El Gasto es Obligatorio',
           'tipo.required' => 'El Tipo de Gasto es Obligatorio'

         ];
     }
}
