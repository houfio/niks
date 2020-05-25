<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('mails/ticket.title', ['subject' => $ticket->subject, 'id' => $ticket->id]) }}</title>
  </head>
  <body>
    <div class="content">
      <span>{{ __('mails/general.title', ['name' => $ticket->getFullName()]) }}</span>
      <p>
        {{ __('mails/ticket.paragraphOne') }}
      </p>
      <p>
        {{ __('mails/ticket.react') }}
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
