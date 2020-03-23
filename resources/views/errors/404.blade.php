@extends('layouts.app')

@section('title', __('errors.not_found.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('errors.not_found.title') }}
    </h1>
    <p>
      {{ __('errors.not_found.description') }}
    </p>
  </div>
@endsection
