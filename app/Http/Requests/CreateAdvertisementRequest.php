<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdvertisementRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:60',
            'short_description' => 'required|max:255|min:30',
            'long_description' => 'nullable',
            'minimum_price' => 'nullable|required_if:enable_bidding,true',
            'price' => 'nullable|numeric|min:1|required_if:enable_bidding,false',
            'is_service' => 'required|boolean',
            'images' => 'required_if:asking,false',
            'images.*' => 'image|mimes:png,jpeg,jpg'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation/messages.required', ['attribute' => ':attribute']),
            'unique' => __('validation/messages.unique', ['attribute' => ':attribute']),
            'email' => __('validation/messages.email', ['value' => ':input']),
            'max' => __('validation/messages.max', ['attribute' => ':attribute', 'max' => ':max']),
            'required_if' => __('validation/messages.required', ['attribute' => ':attribute']),
            'numeric' => __('validation/messages.numeric', ['attribute' => ':attribute']),
            'min' => __('validation/messages.min', ['attribute' => ':attribute']),
            'boolean' => __('validation/messages.boolean', ['attribute' => ':attribute']),
            'image' => __('validation/messages.image', ['attribute' => ':attribute'])
        ];
    }

    public function attributes()
    {
        return [
            'title' => __('general/attributes.title'),
            'short_description' => __('general/attributes.short_description'),
            'long_description' => __('general/attributes.long_description'),
            'enable_bidding' => __('general/attributes.enable_bidding'),
            'minimum_price' => __('general/attributes.minimum_price'),
            'price' => __('general/attributes.price'),
            'is_service' => __('general/attributes.is_service'),
            'asking' => __('general/attributes.asking'),
            'images' => __('general/attributes.images')
        ];
    }
}
