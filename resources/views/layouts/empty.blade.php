@extends('layouts.app')

@section('content')
  <div class="centered">
    <i class="fas fa-@yield('icon') fa-5x"></i>
    <div style="margin-top: 1rem">
      @yield('empty')
    </div>
  </div>
@endsection
