@extends('layouts.app')

@section('title', __('errors.server_error.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('errors.server_error.title') }}
    </h1>
    <p>
      {{ __('errors.server_error.description') }}
    </p>
  </div>
@endsection
