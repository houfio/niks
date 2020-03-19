@extends('layouts.app')

@section('title', __('updateUser.title', ['fullName' => "$user->first_name $user->last_name"]))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('updateUser.title', ['fullName' => "$user->first_name $user->last_name"]) }}
    </h1>
    <x-errors/>
    <form method="post" action="{{ @action('UserController@update', ['user' => $user->id]) }}">
      @csrf
      @method('put')
      <div class="text-input">
        <label for="first_name">{{ __('validation.attributes.first_name') }}</label>
        <input type="text" id="first_name" name="first_name" value="{{ $user->first_name }}" required/>
      </div>
      <div class="text-input">
        <label for="last_name">{{ __('validation.attributes.last_name') }}</label>
        <input type="text" id="last_name" name="last_name" value="{{ $user->last_name }}" required/>
      </div>
      <div class="text-input">
        <label for="email">{{ __('validation.attributes.email') }}</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}" required/>
      </div>
      <div class="text-input">
        <label for="phone_number">{{ __('validation.attributes.phone_number') }}</label>
        <input type="text" id="phone_number" name="phone_number" value="{{ $user->phone_number }}" required/>
      </div>
      <div class="text-input">
        <label for="zip_code">{{ __('validation.attributes.zip_code') }}</label>
        <input type="text" id="zip_code" name="zip_code" value="{{ $user->zip_code }}" required/>
      </div>
      <div class="text-input">
        <label for="house_number">{{ __('validation.attributes.house_number') }}</label>
        <input type="text" id="house_number" name="house_number" value="{{ $user->house_number }}" required/>
      </div>
      <div class="text-input">
        <label for="neighbourhood">{{ __('validation.attributes.neighbourhood') }}</label>
        <input type="text" id="neighbourhood" name="neighbourhood" value="{{ $user->neighbourhood }}"/>
      </div>
      <div class="checkbox-input">
        <input type="checkbox" id="is_approved" name="is_approved" @if($user->approved) checked @endif/>
        <label for="is_approved" dusk="approved">{{ __('validation.attributes.is_approved') }}</label>
      </div>
      <div class="checkbox-input">
        <input type="checkbox" id="is_admin" name="is_admin" @if($user->is_admin) checked @endif/>
        <label for="is_admin" dusk="admin">{{ __('validation.attributes.is_admin') }}</label>
      </div>
      <button type="submit" class="button" name="edit">
        {{ __('updateUser.submit') }}
      </button>
    </form>
  </div>
@endsection
