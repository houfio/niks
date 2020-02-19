<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestAccount extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|unique:users,email|email|max:255',
            'firstName' => 'required|max:255',
            'middleName' => 'required|max:255',
            'lastName' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation.required', ['attribute' => ':attribute']),
            'unique' => __('validation.attributes.email', ['attribute' => ':attribute']),
            'max' => __('validation.max', ['attribute' => ':attribute', 'max' => ':max'])
        ];
    }

    public function attributes()
    {
        return [
            'email' => __('validation.attributes.email'),
            'firstName' => __('validation.attributes.firstName'),
            'middleName' => __('validation.attributes.middleName'),
            'lastName' => __('validation.attributes.lastName'),
        ];
    }
}
