<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
{
    public function authorize()
    {
        $user = User::whereEmail($this->request->get('email'))->first();

        if (!$user) {
            return false;
        }

        return $user->is_approved;
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
            'required' => __('validation/messages.required', ['attribute' => ':attribute']),
            'email' => __('validation/messages.email', ['value' => ':input']),
            'exists' => __('validation/messages.exists', ['attribute' => ':attribute']),
        ];
    }

    public function attributes()
    {
        return [
            'email' => __('general/attributes.email'),
        ];
    }
}
