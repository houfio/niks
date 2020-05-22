<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InterviewRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'invitee' => 'required|numeric',
            'date' => 'date|required|after:today'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation/messages.required', ['attribute' => ':attribute']),
            'numeric' => __('validation/messages.integer', ['value' => ':input']),
            'date' => __('validation/messages.date', ['value' => ':input']),
            'after' => __('validation/messages.after_today', ['attribute' => ':attribute'])
        ];
    }

    public function attributes()
    {
        return [
            'invitee' => __('views/interview.invitee'),
            'date' => __('views/interview.date')
        ];
    }
}
