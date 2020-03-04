<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|confirmed|min:6|max:255'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation.required', ['attribute' => ':attribute']),
            'min' => __('validation.min', ['attribute' => ':attribute', 'min' => ':min']),
            'max' => __('validation.max', ['attribute' => ':attribute', 'max' => ':max'])
        ];
    }

    public function attributes()
    {
        return [
            'password' => __('validation.attributes.password')
        ];
    }
}
