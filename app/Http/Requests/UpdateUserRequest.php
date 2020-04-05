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
            'is_admin' => 'in:on,null',
            'is_approved' => 'in:on,null'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation/messages.required', ['attribute' => ':attribute']),
            'unique' => __('validation/messages.unique', ['attribute' => ':attribute']),
            'email' => __('validation/messages.email', ['value' => ':input']),
            'max' => __('validation/messages.max', ['attribute' => ':attribute', 'max' => ':max']),
            'phone_number' => __('validation/messages.phone_number', ['value' => ':input']),
            'zip_code' => __('validation/messages.zip_code', ['value' => ':input']),
            'boolean' => __('validation/messages.boolean', ['attribute' => ':attribute'])
        ];
    }

    public function attributes()
    {
        return [
            'email' => __('general/attributes.email'),
            'first_name' => __('general/attributes.first_name'),
            'last_name' => __('general/attributes.last_name'),
            'phone_number' => __('general/attributes.phone_number'),
            'zip_code' => __('general/attributes.zip_code'),
            'house_number' => __('general/attributes.house_number'),
            'neighbourhood' => __('general/attributes.neighbourhood'),
            'is_admin' => __('general/attributes.is_admin'),
            'is_approved' => __('general/attributes.is_approved')
        ];
    }
}
