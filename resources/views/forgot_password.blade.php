@extends('layouts.app')

@section('title', __('forgotPassword.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('forgotPassword.title') }}
    </h1>
    <x-errors/>
    <form method="post" action="{{ @action('Auth\ForgotPasswordController@forgotPassword') }}">
      @csrf
      <div class="text-input">
        <label for="email">{{ __('validation.attributes.email') }}</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required/>
      </div>
      <button type="submit" class="button" name="forgot">
        {{ __('forgotPassword.submit') }}
      </button>
      <a class="button transparent" href="{{ url('login') }}">
        {{ __('login.title') }}
      </a>
    </form>
  </div>
@endsection
