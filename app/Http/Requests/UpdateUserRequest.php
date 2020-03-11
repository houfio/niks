<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => "required|unique:users,email,{$this->user->id}|email|max:255",
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone_number' => 'required|phone_number',
            'zip_code' => 'required|zip_code|max:6',
            'house_number' => 'required|max:6',
            'neighbourhood' => 'max:80',
            'is_admin' => 'boolean',
            'approved' => 'boolean'
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
            'boolean' => __('validation.boolean', ['attribute' => ':attribute'])
        ];
    }

    public function attributes()
    {
        return [
            'email' => __('validation.attributes.email'),
            'first_name' => __('validation.attributes.first_name'),
            'last_name' => __('validation.attributes.last_name'),
            'phone_number' => __('validation.attributes.phone_number'),
            'zip_code' => __('validation.attributes.zip_code'),
            'house_number' => __('validation.attributes.house_number'),
            'neighbourhood' => __('validation.attributes.neighbourhood'),
            'is_admin' => __('validation.attributes.is_admin'),
            'approved' => __('validation.attributes.approved')
        ];
    }
}
