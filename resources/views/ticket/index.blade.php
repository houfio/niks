@extends('layouts.app')

@section('theme', 'dark')

@section('title', __('views/tickets.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('views/tickets.title') }}
    </h1>
    <x-errors/>
  </div>
  @foreach($tickets as $ticket)
    <div class="list-item" data-href="{{ @action('TicketController@edit', ['ticket' => $ticket]) }}">
      <span id="user">{{ $ticket->getFullName() }} - {{ $ticket->created_at->format('Y-m-d H:i') }}</span>
      <div class="spacer"></div>
    </div>
  @endforeach
@endsection
