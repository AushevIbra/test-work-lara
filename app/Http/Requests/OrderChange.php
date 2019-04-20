<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderChange extends FormRequest
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

    public function messages()
    {
        return [
            'client_email.required' => 'Заполните email',
            'client_email.email' => 'Неправильно заполнена почта',
            'partner_id.required' => 'Выберите партнера',
            'status.required' => 'Выберите статус заказа',
            'products.*' => 'Введите количество'

        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client_email' => 'required|email',
            'partner_id' => 'required',
            'status' => 'required',
            'products.*' => 'required'
        ];
    }
}
