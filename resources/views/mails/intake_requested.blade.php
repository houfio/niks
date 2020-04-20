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
          {{ __('mails/intake.date') }}: {{ \Carbon\Carbon::parse($intake->date)->format('d-m-Y') }}
        </li>
        <li>
          {{ __('mails/intake.time') }}: {{ \Carbon\Carbon::parse($intake->date)->format('H:i') }}
        </li>
      </ul>
      <p>
        {{ __('mails/intake.requested.paragraphTwo') }}
        <a href="{{ route('accept_intake', ['token' => $intake->token, 'accepted' => 1]) }}" class="button">
          {{ __('mails/intake.accept') }}
        </a>
        <a href="{{ route('accept_intake', ['token' => $intake->token, 'accepted' => 0]) }}" class="button">
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
