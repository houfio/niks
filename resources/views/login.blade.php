@extends('layouts.app')

@section('title', __('login.title'))

@section('content')
  <div class="content">
    @if ($errors->any())
      @foreach ($errors->all() as $error)
        <div class="error">{{ __($error) }}</div>
      @endforeach
    @endif
    @include('components/login_form')
  </div>
@endsection
