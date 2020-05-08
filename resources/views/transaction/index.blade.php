@extends('layouts.app')

@section('theme', 'dark')

@section('title', __('views/transactions.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('views/transactions.title') }}
    </h1>
    <x-errors/>
  </div>
@endsection
