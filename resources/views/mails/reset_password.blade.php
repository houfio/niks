<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('mail.views/resetPassword.title') }}</title>
  </head>
  <body>
    <div class="content">
      <span>{{ __('mails/general.title', ['name' => "$user->first_name $user->last_name"]) }}</span>
      <p>
        {{ __('mails/resetPassword.paragraphOne') }}
      </p>
      <p>
        {{ env('APP_URL') }}/reset/{{ $token }}
      </p>
      <p>
        {{ __('mails/resetPassword.paragraphTwo') }}
      </p>
      <span>
        {{ __('mails/general.greetings') }}<br/>
        {{ __('mails/general.team') }}
      </span>
    </div>
  </body>
</html>
