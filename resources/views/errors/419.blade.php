@extends('layouts.app')

@section('title', __('errors.expired.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('errors.expired.title') }}
    </h1>
    <p>
      {{ __('errors.expired.description') }}
    </p>
  </div>
@endsection
