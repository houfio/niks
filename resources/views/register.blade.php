@extends('layouts.app')

@section('title', __('register.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('register.title') }}
    </h1>
    <x-errors/>
    <form class="two-columns" method="post" action="{{ @action('Auth\RegisterController@register') }}">
      @csrf
      <div class="text-input">
        <label for="first_name">{{ __('validation.attributes.first_name') }}</label>
        <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required/>
      </div>
      <div class="text-input">
        <label for="last_name">{{ __('validation.attributes.last_name') }}</label>
        <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required/>
      </div>
      <div class="text-input">
        <label for="email">{{ __('validation.attributes.email') }}</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required/>
      </div>
      <div class="text-input">
        <label for="phone_number">{{ __('validation.attributes.phone_number') }}</label>
        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required/>
      </div>
      <div class="text-input">
        <label for="zip_code">{{ __('validation.attributes.zip_code') }}</label>
        <input type="text" id="zip_code" name="zip_code" value="{{ old('zip_code') }}" required/>
      </div>
      <div class="text-input">
        <label for="house_number">{{ __('validation.attributes.house_number') }}</label>
        <input type="text" id="house_number" name="house_number" value="{{ old('house_number') }}" required/>
      </div>
      <button class="button" type="submit" name="register">
        {{ __('register.title') }}
      </button>
    </form>
  </div>
@endsection
