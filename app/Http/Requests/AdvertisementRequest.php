<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisementRequest extends FormRequest
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
            'minimum_price' => 'nullable|min:1|required_if:enable_bidding,true',
            'price' => 'nullable|numeric|min:1|required_if:enable_bidding,false',
            'is_service' => 'required|boolean',
            'images' => 'required_if:is_asking,false',
            'images.*' => 'image|mimes:png,jpeg,jpg',
            'enable_bidding' => 'in:on,null',
            'is_asking' => 'in:on,null',
            'delete_images' => 'nullable'
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
            'min' => __('validation/messages.min', ['attribute' => ':attribute', 'min' => ':min']),
            'boolean' => __('validation/messages.boolean', ['attribute' => ':attribute']),
            'image' => __('validation/messages.image', ['attribute' => ':attribute']),
            'minimum_price.min' => __('validation/messages.min_num', ['attribute' => ':attribute', 'min' => ':min']),
            'price.min' => __('validation/messages.min_num', ['attribute' => ':attribute', 'min' => ':min']),
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
            'is_asking' => __('general/attributes.is_asking'),
            'images' => __('general/attributes.images')
        ];
    }
}
