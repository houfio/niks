@extends('layouts.app')

@section('title')
  {{ __('views/profile.title') }} - {{ $user->first_name }} {{ $user->last_name }}
@endsection

@section('content')
  <div class="profile-header">
    <div class="profile-info">
      <div class="profile-image"></div>
      {{ $user->first_name }} {{ $user->last_name }}
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
