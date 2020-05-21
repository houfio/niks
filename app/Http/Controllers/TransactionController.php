<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Transaction;

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
        return view('transaction.index', [
            'transactions' => Transaction::paginate()
        ]);
    }

    public function show(Transaction $transaction)
    {
        return view('transaction.show', [
            'transaction' => $transaction
        ]);
    }
}
