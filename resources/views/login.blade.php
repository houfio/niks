@extends('layouts.app')

@section('title', __('login.title'))

@section('content')
  <div class="content">
    <div class="error">{{ __('login.timeout') }}</div>
    @if ($errors->any())
      @foreach ($errors->all() as $error)
        <div class="error">{{ __($error) }}</div>
      @endforeach
    @endif
    @include('components/login_form')
  </div>
@endsection
