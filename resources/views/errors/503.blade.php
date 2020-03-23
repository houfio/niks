@extends('layouts.app')

@section('title', __('errors.service_unavailable.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('errors.service_unavailable.title') }}
    </h1>
    <p>
      {{ __('errors.service_unavailable.description') }}
    </p>
  </div>
@endsection
