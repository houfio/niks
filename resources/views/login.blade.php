@extends('layouts.app')

@section('title', __('login.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('login.title') }}
    </h1>
    <x-errors/>
    <x-login-form/>
  </div>
@endsection
