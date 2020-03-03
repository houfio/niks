<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('resetPassword.title') }}</title>
  </head>
  <body>
    <div class="content">
      @if ($errors->any())
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      @endif
      <form method="POST" action="{{ @action('Auth\ForgotPasswordController@resetPassword') }}">
        @csrf
        <label for="email">{{ __('resetPassword.email') }}</label><br>
        <input type="email" id="email" name="email"><br>
        <input type="submit" name="reset">
      </form>
    </div>
  </body>
</html>
