@extends('layouts.app')

@section('title')
  {{ __('views/profile.title') }} - {{ $user->getFullName() }}
@endsection

@section('content')
  <div
    class="profile-header"
    @if(isset($user->header)) style="background-image: url('{{ $user->header->url() }}')" @endif
  >
    <div class="profile-info">
      <div
        class="profile-image"
        @if(isset($user->avatar)) style="background-image: url('{{ $user->avatar->url() }}')" @endif
      ></div>
      <span dusk="user_name">
        {{ $user->getFullName() }}
        @can('update', $user)
          <span class="subtle">
            - {{ $user->getAmount() }} niksen
          </span>
        @endcan
      </span>
      <div>
        @if($user->id != auth()->id())
          <button class="button small" data-micromodal-trigger="transaction-modal" dusk="transfer">
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
  </div>
  <div class="content">
    <x-errors/>
  </div>
  @foreach($advertisements as $advertisement)
    <x-advertisement :advertisement="$advertisement"/>
  @endforeach
  {{ $advertisements->links() }}
  <x-modal id="transaction" :title="__('views/transactions.title')">
    <form method="post" action="{{ @action('TransactionController@store') }}">
      @csrf
      <x-input name="amount" :label="__('views/transactions.amount')"/>
      <input type="hidden" name="to" id="to" value="{{ $user->id }}">
      <button dusk="create_transaction" class="button" type="submit">
        {{ __('views/transactions.pay') }}
      </button>
    </form>
  </x-modal>
@endsection
