@extends('layouts.app')

@can('edit-all')
  @section('theme', 'dark')
@endcan

@section('title', __('views/updateTicket.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('views/updateTicket.title') }}
    </h1>
    <x-errors/>
    <form method="post" action="{{ @action('TicketController@update', ['ticket' => $ticket]) }}">
      @csrf
      @method('put')
      <x-input
        name="response"
        type="textarea"
        :value="old('response')"
        :label="__('general/attributes.description')"
        required
      />
      <div class="button-group">
        <button type="submit" class="button" name="reply">
          {{ __('views/updateTicket.submit') }}
        </button>
      </div>
    </form>
    <p>
      {{ $ticket->description }} ({{ $ticket->type->type }})
    </p>
    <h2 class="page-heading">
      {{ __('views/updateTicket.responses') }}
    </h2>
  </div>
  @forelse($responses as $response)
    <div class="list-item" id="response_item">
      <div>
        <p>{{ $response->response }}</p>
      </div>
      <div class="spacer"></div>
      - {{ $response->user->getFullname() }}
    </div>
  @empty
    <div class="content">
      {{ __('views/updateTicket.no_responses') }}
    </div>
  @endforelse
@endsection
