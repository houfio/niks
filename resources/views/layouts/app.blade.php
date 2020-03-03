<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap"/>
    <link rel="stylesheet" href="/css/app.css"/>
    <script src="https://kit.fontawesome.com/87fd30a5b8.js"></script>
  </head>
  <body class="container">
    <nav class="navigation">
      @component('components/navigation_item', ['icon' => 'newspaper', 'path' => '/'])
        {{ __('home.title') }}
      @endcomponent
      @guest
        @component('components/navigation_item', ['icon' => 'envelope-open-text', 'path' => 'register'])
          {{ __('register.title') }}
        @endcomponent
        @if(!Request::is('login'))
          <button class="button" data-micromodal-trigger="login-modal">
            {{ __('login.title') }}
          </button>
        @endif
      @endguest
      @auth
        @component('components/navigation_item', ['icon' => 'store', 'path' => 'advertisements'])
          {{ __('advertisements.title') }}
        @endcomponent
        @component('components/navigation_item', ['icon' => 'star', 'path' => 'favorites'])
          {{ __('favorites.title') }}
        @endcomponent
        @component('components/navigation_item', ['icon' => 'envelope', 'path' => 'messages'])
          {{ __('messages.title') }}
        @endcomponent
        @component('components/navigation_item', ['icon' => 'user', 'path' => 'profile'])
          {{ __('profile.title') }}
        @endcomponent
      @endauth
    </nav>
    <main>
      @yield('content')
    </main>
    @guest
      @if(!Request::is('login'))
        @component('components/modal', ['id' => 'login-modal', 'title' => __('login.title')])
          @include('components/login_form')
        @endcomponent
      @endif
    @endguest
    <script src="/js/app.js"></script>
  </body>
</html>
