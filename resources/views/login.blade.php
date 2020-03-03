@extends('layouts.app')

@section('title', __('login.title'))

@section('content')
  <div class="content">
    @include('components/errors')
    @include('components/login_form')
  </div>
@endsection
