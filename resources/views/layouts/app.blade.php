<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Niksvoorniks - @yield('title')</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap"/>
    <link rel="stylesheet" href="/css/app.css"/>
    <script src="https://kit.fontawesome.com/87fd30a5b8.js"></script>
  </head>
  <body class="container">
    <nav class="navigation">
      @component('components/navigation_item', ['icon' => 'newspaper', 'path' => '/'])
        Home
      @endcomponent
      @component('components/navigation_item', ['icon' => 'store', 'path' => '/advertisements'])
        Advertenties
      @endcomponent
      @component('components/navigation_item', ['icon' => 'star', 'path' => '/favorites'])
        Favorieten
      @endcomponent
      @component('components/navigation_item', ['icon' => 'envelope', 'path' => '/messages'])
        Berichten
      @endcomponent
      @component('components/navigation_item', ['icon' => 'user', 'path' => '/profile'])
        Profiel
      @endcomponent
    </nav>
    <main>
      @yield('content')
    </main>
    <script src="/js/app.js"></script>
  </body>
</html>
