<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketResponseRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            'response' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation/messages.required', ['attribute' => ':attribute'])
        ];
    }

    public function attributes()
    {
        return [
            'response' => __('general/attributes.response')
        ];
    }
}
