@extends('layouts.app')

@section('title', __('views/login.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('views/login.title') }}
    </h1>
    <x-errors/>
    <x-login-form/>
  </div>
@endsection
