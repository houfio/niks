<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdvertisementRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:60',
            'short_description' => 'required|max:255|min:30',
            'long_description' => 'nullable',
            'enable_bidding' => 'required|boolean',
            'minimum_price' => 'nullable|required_if:enable_bidding,true',
            'price' => 'nullable|numeric|min:1|required_if:enable_bidding,false',
            'is_service' => 'required|boolean',
            'asking' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation.required', ['attribute' => ':attribute']),
            'unique' => __('validation.unique', ['attribute' => ':attribute']),
            'email' => __('validation.email', ['value' => ':input']),
            'max' => __('validation.max', ['attribute' => ':attribute', 'max' => ':max']),
            'required_if' => __('validation.required', ['attribute' => ':attribute']),
            'numeric' => __('validation.numeric', ['attribute' => ':attribute']),
            'min' => __('validation.min', ['attribute' => ':attribute']),
            'boolean' => __('validation.boolean', ['attribute' => ':attribute'])
        ];
    }

    public function attributes()
    {
        return [
            'title' => __('validation.attributes.title'),
            'short_description' => __('validation.attributes.short_description'),
            'long_description' => __('validation.attributes.long_description'),
            'enable_bidding' => __('validation.attributes.enable_bidding'),
            'minimum_price' => __('validation.attributes.minimum_price'),
            'price' => __('validation.attributes.price'),
            'is_service' => __('validation.attributes.is_service'),
            'asking' => __('validation.attributes.asking')
        ];
    }
}
