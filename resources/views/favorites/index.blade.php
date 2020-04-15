@extends('layouts.app')

@section('title', __('views/favorites.title'))

@section('content')
  <x-errors/>
  <x-empty icon="star">
    {{ __('views/favorites.empty') }}
  </x-empty>
@endsection
