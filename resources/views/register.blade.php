@extends('layouts.app')

@section('title', __('views/register.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('views/register.title') }}
    </h1>
    <div class="page-subheadings">
      <span>
        {{ __('views/register.subtitle_1') }}
      </span>
      <span>
        {{ __('views/register.subtitle_2') }}
      </span>
      <span>
        {{ __('views/register.subtitle_3') }}
      </span>
    </div>
    <x-errors/>
    <form method="post" action="{{ @action('Auth\RegisterController@register') }}">
      @csrf
      <div class="two-columns">
        <x-input name="first_name" :label="__('general/attributes.first_name')" required/>
        <x-input
          name="last_name"
          :label="__('general/attributes.last_name')"
          :help="__('views/register.last_name_help')"
          required
        />
        <x-input name="email" type="email" :label="__('general/attributes.email')" required/>
        <x-input
          name="phone_number"
          :label="__('general/attributes.phone_number')"
          :help="__('views/register.phone_number_help')"
          required
        />
        <x-input
          name="zip_code"
          :label="__('general/attributes.zip_code')"
          :help="__('views/register.zip_code_help')"
          required
        />
        <x-input
          name="house_number"
          :label="__('general/attributes.house_number')"
          :help="__('views/register.house_number_help')"
          required
        />
      </div>
      <x-input
        name="motivation"
        type="textarea"
        :label="__('general/attributes.motivation')"
        :help="__('views/register.motivation_help')"
        required
      />
      <button class="button" type="submit" name="register">
        {{ __('views/register.title') }}
      </button>
      <a class="button light" href="{{ url('login') }}">
        {{ __('views/login.title') }}
      </a>
    </form>
  </div>
@endsection
