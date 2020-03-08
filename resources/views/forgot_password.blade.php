<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('forgotPassword.title') }}</title>
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
        <label for="email">{{ __('validation.attributes.email') }}</label><br>
        <input type="email" id="email" name="email"><br>
        <input type="submit" name="forgot">
      </form>
    </div>
  </body>
</html>
