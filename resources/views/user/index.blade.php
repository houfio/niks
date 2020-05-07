@extends('layouts.app')

@section('theme', 'dark')

@section('title', __('views/users.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('views/users.title') }}
    </h1>
    <x-errors/>
  </div>
  @foreach($users as $user)
    <div class="list-item" data-href="{{ @action('UserController@edit', ['user' => $user]) }}">
      <span id="user">{{ $user->getFullName() }}</span>
      <div class="spacer"></div>
      @if(!$user->is_approved)
        <form action="{{ @action('Auth\ApproveController@approve', ['user' => $user]) }}" method="post">
          @csrf
          @method('put')
          <div>
            <button type="submit" name="approve" value="1" class="button" dusk="approve_{{ $user->id }}">
              {{ __('views/users.approve') }}
            </button>
            <button type="submit" name="approve" value="0" class="button" dusk="disapprove_{{ $user->id }}">
              {{ __('views/users.reject') }}
            </button>
          </div>
        </form>
      @endif
    </div>
  @endforeach
@endsection

@section('sidebar')
  <div class="sidebar">
    <form method="get" action="{{ @action('UserController@index') }}">
      <x-input name="search" :label="__('views/users.search')"/>
      <x-input name="sort" :label="__('views/users.sort_by')" type="select">
        <option></option>
        @foreach(['first_name' => 'general/attributes.first_name', 'last_name' => 'general/attributes.last_name', 'email' => 'general/attributes.email'] as $key => $label)
          <option @if(request()->get('sort') === $key) selected @endif value="{{ $key }}">
            {{ __($label) }}
          </option>
        @endforeach
      </x-input>
      <x-input name="direction" :label="__('views/users.sort_direction')" type="select">
        <option></option>
        @foreach(['asc' => 'views/users.asc', 'desc' => 'views/users.desc'] as $key => $label)
          <option @if(request()->get('direction') === $key) selected @endif value="{{ $key }}">
            {{ __($label) }}
          </option>
        @endforeach
      </x-input>
      <button class="button" type="submit" dusk="search">
        {{ __('views/users.search_button') }}
      </button>
    </form>
  </div>
@endsection
