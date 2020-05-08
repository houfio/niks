@extends('layouts.app')

@section('title')
  {{ __('views/profile.title') }} - {{ $user->getFullName() }}
@endsection

@section('content')
  <div class="profile-header">
    <div class="profile-info">
      <div class="profile-image"></div>
      {{ $user->getFullName() }}
      @can('update', $user)
        <a class="button light small" href="{{ action('UserController@edit', ['user' => $user]) }}">
          {{ __('views/profile.edit') }}
        </a>
      @endcan
    </div>
  </div>
  @if(count($advertisements))
    @foreach($advertisements as $advertisement)
      <x-advertisement :advertisement="$advertisement"/>
    @endforeach
    {{ $advertisements->links() }}
  @else
    <x-empty icon="store">
      {{ __('views/advertisements.empty') }}
    </x-empty>
  @endif
@endsection