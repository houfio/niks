@extends('layouts.app')

@section('title', __('register.title'))

@section('content')
  <div class="content">
    <x-errors/>
    <form method="post" action="{{ @action('Auth\RegisterController@register') }}">
      @csrf
      <label for="firstName">Voornaam:</label><br>
      <input type="text" id="firstName" name="firstName"><br>
      <label for="lastName">Achternaam:</label><br>
      <input type="text" id="lastName" name="lastName">
      <label for="email">E-mailadres:</label><br>
      <input type="email" id="email" name="email">
      <label for="phoneNumber">Telefoonnummer:</label><br>
      <input type="text" id="phoneNumber" name="phoneNumber">
      <label for="zipCode">Postcode:</label><br>
      <input type="text" id="zipCode" name="zipCode">
      <label for="houseNumber">Huisnummer:</label><br>
      <input type="text" id="houseNumber" name="houseNumber">
      <input type="submit" name="requestAccount">
    </form>
  </div>
@endsection
