@extends('layouts.app')

@section('theme', 'dark')

@section('title', __('views/category.title'))

@section('content')
  @if($categories)
  <div class="content">
    <h1 class="page-heading">
      {{ __('views/category.title') }}
    </h1>
    <x-errors/>
  </div>
  <div class="advertisement">
    <x-admin-category :children="$categories" :depth="0"/>
  </div>
  @else
      <x-errors/>
      <x-empty icon="list-alt">
        {{ __('views/category.empty') }}
      </x-empty>
    @endif
@endsection

@section('sidebar')
  <div class="sidebar">
    <a class="button" href="{{ url('/categories/create') }}">
      {{ __('views/category.create') }}
    </a>
  </div>
@endsection
