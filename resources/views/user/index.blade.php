@extends('layouts.app')

@section('theme', 'dark')

@section('title', __('users.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('users.title') }}
    </h1>
    @foreach($users as $user)
      @if( !$user->is_approved )
        <form action="{{ @action('Auth\ApproveController@approve', ['user' => $user]) }}" method="post">
          @csrf
          @method('put')
          <div>
            {{ $user->getFullName() }}
            <button type="submit" name="approve" value="1" class="button">Goedkeuren</button>
            <button type="submit" name="approve" value="0" class="button">Afkeuren</button>
          </div>
        </form>
      @endif
    @endforeach
  </div>
@endsection
