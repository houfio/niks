<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('mail.accountRequested.title') }}</title>
  </head>
  <body>
    <div class="content">
      @if ($errors->any())
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      @endif
      <form method="POST" action="{{ @action('AccountController@create') }}">
        @csrf
        <label for="firstName">Voornaam:</label><br>
        <input type="text" id="firstName" name="firstName"><br>
        <label for="lastName">Achternaam:</label><br>
        <input type="text" id="lastName" name="lastName">
        <label for="email">E-mailadres:</label><br>
        <input type="email" id="email" name="email">
        <input type="submit" name="submit">
      </form>
    </div>
  </body>
</html>
