<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'phoneNumber' => 'required|phone_number',
            'zipCode' => 'required|zip_code|max:6',
            'houseNumber' => 'required|max:6'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation.required', ['attribute' => ':attribute']),
            'unique' => __('validation.unique', ['attribute' => ':attribute']),
            'max' => __('validation.max', ['attribute' => ':attribute', 'max' => ':max']),
            'phone_number' => __('validation.phone_number', ['value' => ':input']),
            'zip_code' => __('validation.zip_code', ['value' => ':input']),
        ];
    }

    public function attributes()
    {
        return [
            'email' => __('validation.attributes.email'),
            'firstName' => __('validation.attributes.firstName'),
            'middleName' => __('validation.attributes.middleName'),
            'lastName' => __('validation.attributes.lastName'),
            'phoneNumber' => __('validation.attributes.phoneNumber'),
            'zipCode' => __('validation.attributes.zipCode'),
            'houseNumber' => __('validation.attributes.houseNumber')
        ];
    }
}
