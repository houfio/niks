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
    <div class="user" data-href="{{ url("/users/$user->id/edit") }}">
      {{ $user->getFullName() }}
      <div class="spacer"></div>
      @if(!$user->is_approved)
        <form action="{{ @action('Auth\ApproveController@approve', ['user' => $user]) }}" method="post">
          @csrf
          @method('put')
          <div>
            <button type="submit" name="approve" value="1" class="button">Goedkeuren</button>
            <button type="submit" name="approve" value="0" class="button">Afkeuren</button>
          </div>
        </form>
      @endif
    </div>
  @endforeach
@endsection
