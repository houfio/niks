@extends('layouts.app')

@section('title', __('errors/tooManyRequests.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('errors/tooManyRequests.title') }}
    </h1>
    <p>
      {{ __('errors/tooManyRequests.description') }}
    </p>
  </div>
@endsection
