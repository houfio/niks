<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('mails/approved.title') }}</title>
  </head>
  <body>
    <div class="content">
      <span>{{ __('mails/general.title', ['name' => $user->getFullName()]) }}</span>
      <p>
        {{ __('mails/approved.paragraphOne') }}
      </p>
      <p>
        {{ __('mails/approved.paragraphTwo') }}
      </p>
      <p>
        {{ route('setup_password', ['token' => $token]) }}
      </p>
      <span>
        {{ __('mails/general.greetings') }}<br/>
        {{ __('mails/general.team') }}
      </span>
    </div>
  </body>
</html>
