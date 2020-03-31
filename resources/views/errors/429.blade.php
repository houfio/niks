@extends('layouts.app')

@section('title', __('errors.too_many_requests.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('errors.too_many_requests.title') }}
    </h1>
    <p>
      {{ __('errors.too_many_requests.description') }}
    </p>
  </div>
@endsection
