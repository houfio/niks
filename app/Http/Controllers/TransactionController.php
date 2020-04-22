<?php

namespace App\Http\Controllers;

use App\Transaction;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Transaction::class, 'transaction');
    }

    public function index()
    {
        return view('transaction.index');
    }
}