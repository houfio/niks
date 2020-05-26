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
            'title' => 'required|max:40',
            'category' => 'required|alpha_num'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation/messages.required', ['attribute' => ':attribute'])
        ];
    }

    public function attributes()
    {
        return [
            'title' => __('general/attributes.category'),
            'category' => __('general/attributes.parent')
        ];
    }
}
