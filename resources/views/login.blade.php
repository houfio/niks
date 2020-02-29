@extends('layouts.app')

@section('title', __('login.title'))

@section('content')
  @if ($errors->any())
    @foreach ($errors->all() as $error)
      <li>{{ __($error) }}</li>
    @endforeach
  @endif
  @include('components/login_form')
@endsection
