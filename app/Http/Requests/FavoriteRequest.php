<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FavoriteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'advertisement' => 'required|exists:advertisements,id'
        ];
    }

    public function messages()
    {
        return [
            'exists' => __('validation/messages.exists', ['attribute' => ':attribute']),
            'required' => __('validation/messages.required', ['attribute' => ':attribute'])
        ];
    }

    public function attributes()
    {
        return [
            'advertisement' => __('general/attributes.advertisement')
        ];
    }
}
