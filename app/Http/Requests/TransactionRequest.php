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
        $sender = User::find($this->request->get('from'));
        $receiver = User::find($this->request->get('to'));

        $senderAmount = $sender->getAmount() - (int)getenv('APP_MIN_AMOUNT');
        $receiverAmount = $receiver->getAmount() + (int)getenv('APP_MAX_AMOUNT');

        return $senderAmount > $receiverAmount ? $receiverAmount : $senderAmount;
    }

    public function rules()
    {
        return [
            'from' => 'required|integer|exists:users,id',
            'to' => 'required|integer|exists:users,id|different:from',
            'amount' => "required|integer|min:1|max:{$this->getMaxAmount()}"
        ];
    }

    public function messages()
    {
        return [
            'required' => __('validation/messages.required', ['attribute' => ':attribute']),
            'max' => __('validation/messages.max_num', ['attribute' => ':attribute', 'max' => ':max']),
            'min' => __('validation/messages.min_num', ['attribute' => ':attribute', 'min' => ':min']),
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
