<?php

namespace App\Http\Requests;

use App\Advertisement;
use Illuminate\Foundation\Http\FormRequest;

class BidRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'bid' => "required|numeric|min:{$this->minimumBid()}"
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation/messages.required', ['attribute' => ':attribute']),
            'min' => __('validation/messages.min', ['attribute' => ':attribute', 'min' => ':min']),
            'numeric' => __('validation/messages.numeric', ['attribute' => ':attribute']),
            'bid.min' => __('validation/messages.min_num', ['attribute' => ':attribute', 'min' => ':min'])
        ];
    }

    public function attributes()
    {
        return [
            'bid' => __('general/attributes.bid')
        ];
    }

    private function minimumBid(): int
    {
        return $this->route('advertisement')->cost() + 1;
    }
}
