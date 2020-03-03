<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('mail.registered.title') }}</title>
  </head>
  <body>
    <div class="content">
      @if ($errors->any())
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      @endif
      <form method="POST" action="{{ @action('Auth\RegisterController@register') }}">
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
        <label for="neighbourhood">Wijk:</label><br>
        <input type="text" id="neighbourhood" name="neighbourhood">
        <input type="submit" name="requestAccount">
      </form>
    </div>
  </body>
</html>
