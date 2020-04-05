@extends('layouts.app')

@section('theme', 'dark')

@section('title', __('views/users.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('views/users.title') }}
    </h1>
    @foreach($users as $user)
      <div>
        {{ $user->getFullName() }}
      </div>
    @endforeach
  </div>
@endsection
