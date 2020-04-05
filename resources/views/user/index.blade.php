@extends('layouts.app')

@section('theme', 'dark')

@section('title', __('users.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('users.title') }}
    </h1>
    @foreach($users as $user)
      <form action="{{ @action('Auth\ApproveController', ['user' => $user->id]) }}" method="post">
        @method('PUT')
        <div>
          {{ $user->getFullName() }} <button type="submit" class="button">Goedkeuren</button>
        </div>
      </form>
    @endforeach
  </div>
@endsection
