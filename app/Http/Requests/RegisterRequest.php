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
            'zip_code' => 'required|zip_code|max:7',
            'house_number' => 'required|max:6',
            'motivation' => 'required|min:10'
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
            'min' => __('validation/messages.min', ['attribute' => ':attribute', 'min' => ':min'])
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
            'motivation' => __('general/attributes.motivation')
        ];
    }
}
