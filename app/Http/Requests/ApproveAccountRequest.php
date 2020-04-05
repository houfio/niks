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
            'approve' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation.required', ['attribute' => ':attribute']),
            'max' => __('validation.max', ['attribute' => ':attribute', 'max' => ':max'])
        ];
    }

    public function attributes()
    {
        return [
            'email' => __('validation.attributes.email'),
            'approve' => __('validation.attributes.approve')
        ];
    }
}
