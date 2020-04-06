@extends('layouts.app')

@section('title', __('errors/serviceUnavailable.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('errors/serviceUnavailable.title') }}
    </h1>
    <p>
      {{ __('errors/serviceUnavailable.description') }}
    </p>
  </div>
@endsection
