@extends('layouts.app')

@section('title', __('users.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('users.title') }}
    </h1>
    @foreach($users as $user)
      <div>
        {{ $user->first_name }} {{ $user->last_name }}
      </div>
    @endforeach
  </div>
@endsection
