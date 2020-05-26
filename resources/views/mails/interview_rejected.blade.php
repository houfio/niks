<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('mails/interview.title') }}</title>
  </head>
  <body>
    <div class="content">
      <span>{{ __('mails/general.title', ['name' => $receiver->getFullName()]) }}</span>
      <p>
        {{ __('mails/interview.rejected.paragraphOne') }}
      </p>
      <ul>
        <li>
          {{ __('mails/interview.name') }}: {{ $interview->invitee->getFullName() }}
        </li>
        <li>
          {{ __('mails/interview.date') }}: {{ $interview->date->format('d-m-Y') }}
        </li>
        <li>
          {{ __('mails/interview.time') }}: {{ $interview->date->format('H:i') }}
        </li>
      </ul>
      <span>
        {{ __('mails/general.greetings') }}<br/>
        {{ __('mails/general.team') }}
      </span>
    </div>
  </body>
</html>
