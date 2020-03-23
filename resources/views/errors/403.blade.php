@extends('layouts.app')

@section('title', __('errors.unauthorized.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('errors.unauthorized.title') }}
    </h1>
    <p>
      {{ __('errors.unauthorized.description') }}
    </p>
  </div>
@endsection
