<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password' => 'required|confirmed|min:10|max:255',
            'email' => 'required|max:255|exists:password_resets,email'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation/messages.required', ['attribute' => ':attribute']),
            'max' => __('validation/messages.max', ['attribute' => ':attribute', 'max' => ':max']),
            'exists' => __('validation/messages.exists', ['attribute' => ':attribute']),
            'min' => __('validation/messages.min', ['attribute' => ':attribute', 'min' => ':min'])
        ];
    }

    public function attributes()
    {
        return [
            'password' => __('general/attributes.password'),
            'password_confirmation' => __('general/attributes.password_confirmation'),
            'email' => __('general/attributes.email')
        ];
    }
}
