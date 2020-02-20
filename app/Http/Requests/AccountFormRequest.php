<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountFormRequest extends FormRequest
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
            'lastName' => 'required|max:255',
            'phoneNumber' => 'required|phone_number'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation.required', ['attribute' => ':attribute']),
            'unique' => __('validation.unique', ['attribute' => ':attribute']),
            'max' => __('validation.max', ['attribute' => ':attribute', 'max' => ':max']),
            'phone_number' => __('validation.phone_number', ['attribute' => ':attribute'])
        ];
    }

    public function attributes()
    {
        return [
            'email' => __('validation.attributes.email'),
            'firstName' => __('validation.attributes.firstName'),
            'middleName' => __('validation.attributes.middleName'),
            'lastName' => __('validation.attributes.lastName'),
            'phoneNumber' => __('validation.attributes.phoneNumber')
        ];
    }
}
