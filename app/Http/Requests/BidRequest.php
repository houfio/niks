<?php

namespace App\Http\Requests;

use App\Bid;
use Illuminate\Foundation\Http\FormRequest;

class BidRequest extends FormRequest
{
    private function highestBid()
    {
        return Bid::select('bid')
            ->whereColumn('advertisement_id', $this->route('advertisement'))
            ->orderBy('bid', 'desc')
            ->limit(1);
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'bid' => "required|numeric|min:{$this->highestBid()}"
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation.required', ['attribute' => ':attribute']),
            'min' => __('validation.min', ['attribute' => ':attribute', 'min' => ':min']),
            'numeric' => __('validation.numeric', ['attribute' => ':attribute'])
        ];
    }

    public function attributes()
    {
        return [
            'bid' => __('validation.attributes.bid')
        ];
    }
}
