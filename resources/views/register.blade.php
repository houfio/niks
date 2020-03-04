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
        <label for="firstName">Voornaam</label>
        <input type="text" id="firstName" name="firstName" value="{{ old('firstName') }}" required/>
      </div>
      <div class="text-input">
        <label for="lastName">Achternaam</label>
        <input type="text" id="lastName" name="lastName" value="{{ old('firstName') }}" required/>
      </div>
      <div class="text-input">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required/>
      </div>
      <div class="text-input">
        <label for="phoneNumber">Telefoonnummer</label>
        <input type="text" id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber') }}" required/>
      </div>
      <div class="text-input">
        <label for="zipCode">Postcode</label>
        <input type="text" id="zipCode" name="zipCode" value="{{ old('zipCode') }}" required/>
      </div>
      <label for="houseNumber">Huisnummer:</label><br>
      <input type="text" id="houseNumber" name="houseNumber">
      <input type="submit" name="requestAccount">
    </form>
  </div>
@endsection
