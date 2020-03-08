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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone_number' => 'required|phone_number',
            'zip_code' => 'required|zip_code|max:6',
            'house_number' => 'required|max:6'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation.required', ['attribute' => ':attribute']),
            'unique' => __('validation.unique', ['attribute' => ':attribute']),
            'email' => __('validation.email', ['value' => ':input']),
            'max' => __('validation.max', ['attribute' => ':attribute', 'max' => ':max']),
            'phone_number' => __('validation.phone_number', ['value' => ':input']),
            'zip_code' => __('validation.zip_code', ['value' => ':input']),
        ];
    }

    public function attributes()
    {
        return [
            'email' => __('validation.attributes.email'),
            'first_name' => __('validation.attributes.firstName'),
            'last_name' => __('validation.attributes.lastName'),
            'phone_number' => __('validation.attributes.phoneNumber'),
            'zip_code' => __('validation.attributes.zipCode'),
            'house_number' => __('validation.attributes.houseNumber')
        ];
    }
}
