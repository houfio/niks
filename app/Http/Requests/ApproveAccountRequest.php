<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApproveAccountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|max:255',
            'approve' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation/messages.required', ['attribute' => ':attribute']),
            'max' => __('validation/messages.max', ['attribute' => ':attribute', 'max' => ':max'])
        ];
    }

    public function attributes()
    {
        return [
            'email' => __('general/attributes.email'),
            'approve' => __('general/attributes.approve')
        ];
    }
}
