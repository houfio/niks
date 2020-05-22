<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('mails/interview.title') }}</title>
  </head>
  <body>
    <div class="content">
      <span>{{ __('mails/general.title', ['name' => $interview->invitee->getFullName()]) }}</span>
      <p>
        {{ __('mails/interview.requested.paragraphOne') }}
      </p>
      <ul>
        <li>
          {{ __('mails/interview.date') }}: {{ $interview->date->format('d-m-Y') }}
        </li>
        <li>
          {{ __('mails/interview.time') }}: {{ $interview->date->format('H:i') }}
        </li>
      </ul>
      <p>
        {{ __('mails/interview.requested.paragraphTwo') }}
        <a href="{{ action('InterviewController@accept', [$interview->id, $token, 'accepted' => 1]) }}" class="button">
          {{ __('mails/interview.accept') }}
        </a>
        <br/>
        <a href="{{ action('InterviewController@accept', [$interview->id, $token, 'accepted' => 0]) }}" class="button">
          {{ __('mails/interview.reject') }}
        </a>
      </p>
      <span>
        {{ __('mails/general.greetings') }}<br/>
        {{ __('mails/general.team') }}
      </span>
    </div>
  </body>
</html>
