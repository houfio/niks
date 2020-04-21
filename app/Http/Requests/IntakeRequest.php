<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IntakeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'invitee' => 'required|numeric',
            'date' => 'date|required'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation/messages.required', ['attribute' => ':attribute']),
            'numeric' => __('validation/messages.integer', ['value' => ':input']),
            'date' => __('validation/messages.date', ['value' => ':input'])
        ];
    }

    public function attributes()
    {
        return [
            'invitee' => __('views/intakes.invitee'),
            'date' => __('views/intakes.date')
        ];
    }
}
