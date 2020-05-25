<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Transaction;
use App\User;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Transaction::class, 'transaction');
    }

    public function index()
    {
        return view('transaction.index', [
            'transactions' => Transaction::paginate()
        ]);
    }

    public function store(TransactionRequest $request)
    {
        $data = $request->validated();
        $receiver = User::find($data['to']);

        $transaction = new Transaction();

        $transaction->amount = (int)$data['amount'];
        $transaction->receiver()->associate($receiver);
        $transaction->sender()->associate($request->user());

        $transaction->save();
        $request->session()->flash('message', __('messages/transaction.sent', ['receiver' => $receiver->getFullName()]));

        return redirect()->action('UserController@show', $receiver->id);
    }

    public function show(Transaction $transaction)
    {
        return view('transaction.show', [
            'transaction' => $transaction
        ]);
    }
}
