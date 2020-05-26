<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category' => 'required|max:40',
            'parent' => 'required_without:type|numeric|exists:categories,id',
            'type' => 'required_without:parent|in:advertisement,post'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation/messages.required', ['attribute' => ':attribute']),
            'unique' => __('validation/messages.unique', ['attribute' => ':attribute']),
            'max' => __('validation/messages.max', ['attribute' => ':attribute', 'max' => ':max']),
            'required_without' => __('validation/messages.required', ['attribute' => ':attribute']),
            'numeric' => __('validation/messages.numeric', ['attribute' => ':attribute']),
            'min' => __('validation/messages.min', ['attribute' => ':attribute', 'min' => ':min']),
            'in' => __('validation/messages.in_category', ['attribute' => ':attribute']),
            'exists' => __('validation/messages.already_exists', ['attribute' => ':attribute'])
        ];
    }

    public function attributes()
    {
        return [
            'category' => __('general/attributes.category'),
            'parent' => __('general/attributes.parent'),
            'type' => __('general/attributes.type')
        ];
    }
}
