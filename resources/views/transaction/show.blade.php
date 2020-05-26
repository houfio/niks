@extends('layouts.app')

@section('theme', 'dark')

@section('title', __('views/transactions.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading" dusk="title">
      {{ __('views/showTransaction.title') }}
    </h1>
    <h3 class="page-heading">
      {{ __('views/showTransaction.sender_title', ['sender' => $sender->getFullName()]) }}
    </h3>
    <div class="three-columns">
      <x-input
        name="old_balance"
        :label="__('views/showTransaction.old_balance')"
        :value="$sender->getAmount($transaction->created_at->addSeconds(-1))"
        disabled
      />
      <x-input
        name="sent"
        :label="__('views/showTransaction.sent')"
        :value="$transaction->amount"
        disabled
      />
      <x-input
        name="new_balance"
        :label="__('views/showTransaction.new_balance')"
        :value="$sender->getAmount($transaction->created_at->addSeconds(1))"
        disabled
      />
    </div>
    <h3 class="page-heading">
      {{ __('views/showTransaction.receiver_title', ['receiver' => $receiver->getFullName()]) }}
    </h3>
    <div class="three-columns">
      <x-input
        name="old_balance"
        :label="__('views/showTransaction.old_balance')"
        :value="$receiver->getAmount($transaction->created_at->addSeconds(-1))"
        disabled
      />
      <x-input
        name="received"
        :label="__('views/showTransaction.received')"
        :value="$transaction->amount"
        disabled
      />
      <x-input
        name="new_balance"
        :label="__('views/showTransaction.new_balance')"
        :value="$receiver->getAmount($transaction->created_at->addSeconds(1))"
        disabled
      />
    </div>
  </div>
@endsection
