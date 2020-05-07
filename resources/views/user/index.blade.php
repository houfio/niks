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
      {{ $user->getFullName() }}
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
    <form method="get" action="{{ @action('UserController@index') }}" style="margin-top: 1rem">
      <x-input name="search" :label="__('views/users.search')"/>
      <x-input name="sort" :label="__('views/users.sort_by')" type="select">
        <option></option>
        @foreach([__('general/attributes.first_name') => 'first_name', __('general/attributes.last_name') => 'last_name', __('general/attributes.email') => 'email'] as $key => $attribute)
          <option @if(request()->get('sort') === $attribute) selected @endif value="{{ $attribute }}">{{ $key }}</option>
        @endforeach
      </x-input>
      <x-input name="direction" :label="__('views/users.sort_direction')" type="select">
        <option></option>
        @foreach(['Gesorteerd van A-Z' => 'asc', 'Gesorteerd van Z-A' => 'desc'] as $key => $direction)
          <option @if(request()->get('direction') === $direction) selected @endif value="{{ $direction }}">{{ $key }}</option>
        @endforeach
      </x-input>
      <button class="button" type="submit" dusk="search">
        {{ __('views/users.search_button') }}
      </button>
    </form>
  </div>
@endsection
