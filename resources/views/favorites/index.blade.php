@extends('layouts.app')

@section('title', __('views/favorites.title'))

@section('content')
  @if(count($favorites))
    <div class="content">
      <h1 class="page-heading">
        {{ __('views/favorites.title') }}
      </h1>
    </div>
    <x-errors/>
    @foreach($favorites as $advertisement)
      <x-advertisement :advertisement="$advertisement"/>
    @endforeach
    {{ $favorites->links() }}
  @else
    <x-errors/>
    <x-empty icon="star">
      {{ __('views/favorites.empty') }}
    </x-empty>
  @endif
@endsection
