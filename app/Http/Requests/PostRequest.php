<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:60',
            'content' => 'required|min:120',
            'header' => 'image|mimes:png,jpeg,jpg',
            'categories' => 'nullable|array',
            'categories.*' => 'integer'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation/messages.required', ['attribute' => ':attribute']),
            'max' => __('validation/messages.max', ['attribute' => ':attribute', 'max' => ':max']),
            'min' => __('validation/messages.min', ['attribute' => ':attribute', 'min' => ':min']),
            'image' => __('validation/messages.image', ['attribute' => ':attribute'])
        ];
    }

    public function attributes()
    {
        return [
            'title' => __('general/attributes.title'),
            'content' => __('general/attributes.content'),
            'header' => __('general/attributes.header')
        ];
    }
}
