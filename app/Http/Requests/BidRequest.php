<?php

namespace App\Http\Requests;

use App\Advertisement;
use Illuminate\Foundation\Http\FormRequest;

class BidRequest extends FormRequest
{
    private function highestBid(): int
    {
        /** @var Advertisement $advertisement */
        $advertisement = $this->route('advertisement');
        $highestBid = $advertisement->bids()->max('bid');
        return is_null($highestBid) ? $advertisement->minimum_price : $highestBid;
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
            'required' => __('validation/messages.required', ['attribute' => ':attribute']),
            'min' => __('validation/messages.min', ['attribute' => ':attribute', 'min' => ':min']),
            'numeric' => __('validation/messages.numeric', ['attribute' => ':attribute'])
        ];
    }

    public function attributes()
    {
        return [
            'bid' => __('general/attributes.bid')
        ];
    }
}
