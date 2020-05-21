<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    private function getMaxAmount(): int
    {
        $from = User::find($this->request->get('from'));
        $to = User::find($this->request->get('to'));

        $fromAmount = $from->getAmount() - (int)getenv('APP_MIN_AMOUNT');
        $toAmount = $to->getAmount() + (int)getenv('APP_MAX_AMOUNT');

        return $fromAmount > $toAmount ? $toAmount : $fromAmount;
    }

    public function rules()
    {
        return [
            'from' => 'required|integer|exists:users,id',
            'to' => 'required|integer|exists:users,id|different:from',
            'amount' => "required|integer|max:{$this->getMaxAmount()}"
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation/messages.required', ['attribute' => ':attribute']),
            'max' => __('validation/messages.max', ['attribute' => ':attribute', 'max' => ':max']),
            'integer' => __('validation/messages.numeric', ['attribute' => ':attribute']),
            'exists' => __('validation/messages.exists', ['attribute' => ':attribute']),
            'different' => __('validation/messages.different', ['attribute' => ':attribute'])
        ];
    }

    public function attributes()
    {
        return [
            'from' => __('general/attributes.from'),
            'to' => __('general/attributes.to'),
            'amount' => __('general/attributes.amount')
        ];
    }
}
