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
            'password' => 'required|confirmed|max:255'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation.required', ['attribute' => ':attribute']),
            'max' => __('validation.max', ['attribute' => ':attribute', 'max' => ':max']),
        ];
    }

    public function attributes()
    {
        return [
            'password' => __('validation.attributes.password'),
            'password_confirmation' => __('validation.attributes.passwordConfirmation'),
        ];
    }
}
