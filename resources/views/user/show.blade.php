@extends('layouts.app')

@section('title')
  {{ __('views/profile.title') }} - {{ $user->getFullName() }}
@endsection

@section('content')
  <div class="profile-header">
    <div class="profile-info">
      <div class="profile-image"></div>
      <span dusk="user_name">{{ $user->getFullName() }}</span>
      @can('update', $user)
        <a class="button light small" href="{{ action('UserController@edit', ['user' => $user]) }}">
          {{ __('views/profile.edit') }}
        </a>
      @endcan
    </div>
  </div>
  @forelse($advertisements as $advertisement)
    <x-advertisement :advertisement="$advertisement"/>
  @empty
    <x-empty icon="store">
      {{ __('views/advertisements.empty') }}
    </x-empty>
  @endforelse
@endsection
