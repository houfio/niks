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
      <form method="POST" action="{{ @action('Auth\ResetPasswordController@reset') }}">
        @csrf
        <label for="password">{{ __('resetPassword.password') }}</label><br>
        <input type="password" id="password" name="password"><br>
        <label for="password_confirmation">{{ __('resetPassword.passwordConfirmation') }}</label><br>
        <input type="password" id="password_confirmation" name="password_confirmation"><br>
        <input type="submit" name="reset">
      </form>
    </div>
  </body>
</html>
