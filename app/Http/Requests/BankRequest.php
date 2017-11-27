<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
     public function rules()
     {
        //  return [
        //    'banco' => 'required|max:255'
         //
        //  ];
     }

    //  public function messages()
    //  {
    //      return [
    //        'banco.required' => 'El campo Banco no puede estar vacio'
     //
    //      ];
    //  }
}
