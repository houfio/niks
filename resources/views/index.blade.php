@extends('layouts.app')

@section('title', __('views/news.title'))

@section('content')
  <x-errors/>
  <x-empty icon="newspaper">
    {{ __('views/news.empty') }}
  </x-empty>
@endsection
