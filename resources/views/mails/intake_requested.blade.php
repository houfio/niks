<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('mails/intake.title') }}</title>
  </head>
  <body>
    <div class="content">
      <span>{{ __('mails/general.title', ['name' => $intake->invitee->getFullName()]) }}</span>
      <p>
        {{ __('mails/intake.requested.paragraphOne') }}
      </p>
      <ul>
        <li>
          {{ __('mails/intake.date') }}: {{ date('d-m-Y', strtotime($intake->date)) }}
        </li>
        <li>
          {{ __('mails/intake.time') }}: {{ date('H:i', strtotime($intake->date)) }}
        </li>
      </ul>
      <p>
        {{ __('mails/intake.requested.paragraphTwo') }}
        <a href="{{ route('accept_intake', ['token' => $intake->token, 'accepted' => true]) }}" class="button">
          {{ __('mails/intake.accept') }}
        </a>
        <a href="{{ route('accept_intake', ['token' => $intake->token, 'accepted' => false]) }}" class="button">
          {{ __('mails/intake.reject') }}
        </a>
      </p>
      <span>
        {{ __('mails/general.greetings') }}<br/>
        {{ __('mails/general.team') }}
      </span>
    </div>
  </body>
</html>
