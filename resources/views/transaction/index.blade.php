@extends('layouts.app')

@section('theme', 'dark')

@section('title', __('views/transactions.title'))

@section('content')
  @if(count($transactions))
    <div class="content">
      <h1 class="page-heading">
        {{ __('views/transactions.title') }}
      </h1>
    </div>
    <x-errors/>
    @foreach($transactions as $transaction)
      <div class="list-item" data-href="{{ url("/transactions/$transaction->id") }}">
        <span class="tag">
          -{{ $transaction->amount }}
        </span>
        {{ $transaction->sender->getFullName() }}
        <i class="fas fa-chevron-right arrow"></i>
        <span class="tag orange">
          +{{ $transaction->amount }}
        </span>
        {{ $transaction->receiver->getFullName() }}
        <div class="spacer"></div>
        {{ $transaction->created_at->diffForHumans() }}
      </div>
    @endforeach
    {{ $transactions->links() }}
  @else
    <x-errors/>
    <x-empty icon="coins">
      {{ __('views/transactions.empty') }}
    </x-empty>
  @endif
@endsection
