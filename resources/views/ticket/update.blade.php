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
        <button type="submit" class="button" name="edit">
          {{ __('views/updateTicket.submit') }}
        </button>
      </div>
    </form>
    <h2 class="page-heading">
      {{ __('views/updateTicket.responses') }}
    </h2>
    @forelse($responses as $response)
      <div class="list-item">
        <p>{{ $response->response }}</p>
        <div class="spacer"></div>
      </div>
    @empty
      <p>{{ __('views/updateTicket.no_responses') }}</p>
    @endforelse
  </div>
@endsection
