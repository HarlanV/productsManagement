<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|min:2',
            'category_id' => 'required|integer|min:1',
            'quantity' => 'required|integer|min:0',
            'price' => 'sometimes|numeric|min:0'
        ];
    }

    /**
     * Get the messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatorio',
            'min' => 'Verifique o valor de :attribute. Minimo de 2',
            'quantity' => 'Verifique se o campo :attribute é um valor numerico e inteiro'
        ];
    }
}
