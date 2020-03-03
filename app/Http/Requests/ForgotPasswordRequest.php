<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return User::whereEmail($this->request->get('email'))->first() != null;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation.required', ['attribute' => ':attribute']),
            'email' => __('validation.email', ['value' => ':input']),
            'exists' => __('validation.exists', ['attribute' => ':attribute']),
        ];
    }

    public function attributes()
    {
        return [
            'email' => __('validation.attributes.email'),
        ];
    }
}
