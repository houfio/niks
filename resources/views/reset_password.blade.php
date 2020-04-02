@extends('layouts.app')

@section('title', __('resetPassword.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('resetPassword.title') }}
    </h1>
    <x-errors/>
    <form method="post" action="{{ @action('Auth\ResetPasswordController@reset', ['token' => $token]) }}">
      @csrf
      <div class="text-input">
        <label for="email">{{ __('validation.attributes.email') }}</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required/>
      </div>
      <div class="two-columns">
        <div class="text-input">
          <label for="password">{{ __('validation.attributes.password') }}</label>
          <input type="password" id="password" name="password" required/>
        </div>
        <div class="text-input">
          <label for="password_confirmation">{{ __('validation.attributes.password_confirmation') }}</label>
          <input type="password" id="password_confirmation" name="password_confirmation" required/>
        </div>
      </div>
      <button type="submit" class="button" name="reset">
        {{ __('resetPassword.submit') }}
      </button>
    </form>
  </div>
@endsection
