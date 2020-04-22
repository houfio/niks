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
    <div class="list-item" data-href="{{ url("/users/$user->id/edit") }}">
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
