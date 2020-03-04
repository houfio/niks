<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('mail.accountRequested.title') }}</title>
  </head>
  <body>
    <div class="content">
      <span>{{ __('mail.title', ['name' => $user->name]) }}</span>
      <p>
        {{ __('mail.accountRequested.paragraphOne') }}
      </p>
      <p>
        {{ __('mail.accountRequested.paragraphTwo') }}
      </p>
      <span>
        {{ __('mail.greetings') }}<br/>
        {{ __('mail.team') }}
      </span>
    </div>
  </body>
</html>
