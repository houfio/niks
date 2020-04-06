@extends('layouts.app')

@section('title', __('errors/notFound.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('errors/notFound.title') }}
    </h1>
    <p>
      {{ __('errors/notFound.description') }}
    </p>
  </div>
@endsection
