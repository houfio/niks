<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('mails/intake.title') }}</title>
  </head>
  <body>
    <div class="content">
      <span>{{ __('mails/general.title', ['name' => $invitee->getFullName()]) }}</span>
      <p>
        {{ __('mails/intake.accepted.paragraphOne') }}
      </p>
      <ul>
        <li>
          {{ __('mails/intake.name') }}: {{ $invitee->getFullName() }}
        </li>
        <li>
          {{ __('mails/intake.date') }}: {{ $date }}
        </li>
        <li>
          {{ __('mails/intake.time') }}: {{ $time }}
        </li>
      </ul>
      <span>
        {{ __('mails/general.greetings') }}<br/>
        {{ __('mails/general.team') }}
      </span>
    </div>
  </body>
</html>