<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'name' => 'required|min:3',
            'email' => 'required|email|min:3',
            'content' => 'required|min:20'
        ];
    }
    public function messages()
    {
        return [
          '*.required' => ':attribute không được để trống!',
            'email.email' => ':attribute không đúng định dạng',
            '*.min' => ':attribute quá ngắn!'
        ];
    }
}
