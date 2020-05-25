<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|max:255',
            'description' => 'required',
            'phone_number' => 'nullable|phone_number',
            'type' => 'required|exists:ticket_types,type'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation/messages.required', ['attribute' => ':attribute']),
            'email' => __('validation/messages.email', ['value' => ':input']),
            'max' => __('validation/messages.max', ['attribute' => ':attribute', 'max' => ':max']),
            'phone_number' => __('validation/messages.phone_number', ['value' => ':input']),
            'exists' => __('validation/messages.exists', ['value' => ':input']),
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => __('general/attributes.first_name'),
            'last_name' => __('general/attributes.last_name'),
            'email' => __('general/attributes.email'),
            'subject' => __('general/attributes.subject'),
            'description' => __('general/attributes.description'),
            'phone_number' => __('general/attributes.phone_number'),
            'type' => __('general/attributes.ticket_subject')
        ];
    }
}
