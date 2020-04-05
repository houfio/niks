<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="theme-@yield('theme', 'light')">
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
      <x-navigation-item icon="newspaper" path="/">
        {{ __('home.title') }}
      </x-navigation-item>
      @guest
        <x-navigation-item icon="envelope-open-text" path="register">
          {{ __('register.title') }}
        </x-navigation-item>
        @if(!Request::is('login'))
          <button class="button" data-micromodal-trigger="login-modal">
            {{ __('login.title') }}
          </button>
        @endif
      @endguest
      @auth
        <x-navigation-item icon="store" path="advertisements">
          {{ __('advertisements.title') }}
        </x-navigation-item>
        <x-navigation-item icon="user" path="profile">
          {{ __('profile.title') }}
        </x-navigation-item>
        @can('viewAny', \App\User::class)
          <x-navigation-item icon="users" path="users" dot="true">
            {{ __('users.title') }}
          </x-navigation-item>
        @endcan
      @endauth
    </nav>
    <div class="main">
      <main @if(!View::hasSection('sidebar')) style="flex: 1" @endif>
        @yield('content')
      </main>
      @if(View::hasSection('sidebar'))
        <aside>
          @yield('sidebar')
        </aside>
      @endif
    </div>
    @guest
      @if(!Request::is('login'))
        <x-modal id="login" :title="__('login.title')">
          <x-login-form/>
        </x-modal>
      @endif
    @endguest
    <script src="/js/app.js"></script>
  </body>
</html>
