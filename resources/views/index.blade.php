@extends('layouts.app')

@section('title', 'Lokale Ruilkring \'s-Hertogenbosch')

@section('content')
  <x-errors/>
  <x-empty icon="newspaper">
    Er zijn nog geen nieuwsberichten
  </x-empty>
@endsection
