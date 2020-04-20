<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IntakeAcceptRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'accepted' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation/messages.required', ['attribute' => ':attribute']),
            'boolean' => __('validation/messages.boolean', ['value' => ':input'])
        ];
    }

    public function attributes()
    {
        return [
            'accepted' => __('views/intakes.accepted')
        ];
    }
}
