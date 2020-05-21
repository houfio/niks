@extends('layouts.app')

@section('title')
  {{ __('views/profile.title') }} - {{ $user->getFullName() }}
@endsection

@section('content')
  <div class="profile-header">
    <div class="profile-info">
      <div class="profile-image"></div>
      <span dusk="user_name">{{ $user->getFullName() }}</span>
      <div>
        @if($user->id != auth()->id())
          <button class="button small" data-micromodal-trigger="transaction-modal">
            {{ __('views/transactions.pay') }}
          </button>
        @endif
        @can('update', $user)
          <a class="button light small" href="{{ action('UserController@edit', ['user' => $user]) }}">
            {{ __('views/profile.edit') }}
          </a>
        @endcan
      </div>
    </div>
    <x-errors/>
  </div>
  @forelse($advertisements as $advertisement)
    <x-advertisement :advertisement="$advertisement"/>
  @empty
    <x-empty icon="store">
      {{ __('views/advertisements.empty') }}
    </x-empty>
  @endforelse
  {{ $advertisements->links() }}
  <x-modal id="transaction" :title="__('views/transactions.title')">
    <form method="post" action="{{ @action('TransactionController@store') }}">
      @csrf
      <x-input name="amount" :label="__('views/transactions.amount')"/>
      <input type="hidden" name="from" id="from" value="{{ auth()->id() }}">
      <input type="hidden" name="to" id="to" value="{{ $user->id }}">
      <button class="button" type="submit">
        {{ __('views/transactions.pay') }}
      </button>
    </form>
  </x-modal>
@endsection
