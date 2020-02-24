<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('login.title') }}</title>
  </head>
  <body>
    <div class="content">
      @if ($errors->any())
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      @endif
      <form method="POST" action="{{ @action('Auth\LoginController@authenticate') }}">
        @csrf
        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="password">Wachtwoord:</label><br>
        <input type="password" id="password" name="password">
        <input type="checkbox" id="rememberMe" name="rememberMe">
        <input type="submit" name="login">
      </form>
    </div>
  </body>
</html>
