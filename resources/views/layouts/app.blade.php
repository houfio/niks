<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="theme-@yield('theme', 'light')">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap"/>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}"/>
    @yield('styles')
  </head>
  <body class="container">
    <nav class="navigation">
      <div class="navigation-header">
        Niksvoorniks
      </div>
      <x-navigation-item icon="newspaper" path="/">
        {{ __('views/home.title') }}
      </x-navigation-item>
      @guest
        <x-navigation-item icon="envelope-open-text" path="register">
          {{ __('views/register.title') }}
        </x-navigation-item>
        @if(!Request::is('login'))
          <button class="button" data-micromodal-trigger="login-modal">
            {{ __('views/login.title') }}
          </button>
        @endif
      @endguest
      @auth
        <x-navigation-item icon="store" path="advertisements">
          {{ __('views/advertisements.title') }}
        </x-navigation-item>
        <x-navigation-item duskSelector="favorites" icon="star" path="favorites">
          {{ __('views/favorites.title') }}
        </x-navigation-item>
        @can('viewAny', \App\User::class)
          <x-navigation-item icon="users" path="users" dot>
            {{ __('views/users.title') }}
          </x-navigation-item>
          <x-navigation-item icon="comments" path="intakes">
            {{ __('views/intakes.title') }}
          </x-navigation-item>
        @endcan
        @can('viewAny', \App\Transaction::class)
          <x-navigation-item icon="coins" path="transactions">
            {{ __('views/transactions.title') }}
          </x-navigation-item>
        @endcan
      @endauth
    </nav>
    <div class="main">
      <main @if(!View::hasSection('sidebar')) class="no-sidebar" @endif>
        @yield('content')
      </main>
      @if(View::hasSection('sidebar'))
        <aside class="aside">
          @yield('sidebar')
        </aside>
      @endif
    </div>
    @guest
      @if(!Request::is('login'))
        <x-modal id="login" :title="__('views/login.title')">
          <x-login-form/>
        </x-modal>
      @endif
    @endguest
    <script src="{{ mix('/js/app.js') }}"></script>
    @yield('scripts')
  </body>
</html>
