@extends('layouts.app')

@section('title', __('errors/serverError.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('errors/serverError.title') }}
    </h1>
    <p>
      {{ __('errors/serverError.description') }}
    </p>
  </div>
@endsection
