@extends('layouts.app')

@section('title', __('login.title'))

@section('content')
  <div class="content">
    <x-errors/>
    <x-login-form/>
  </div>
@endsection
