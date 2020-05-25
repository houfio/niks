@extends('layouts.app')

@section('title', __('views/ticket.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('views/ticket.title') }}
    </h1>
    <x-errors/>
    <form method="post" action="{{ @action('TicketController@store') }}">
      @csrf
      <div class="two-columns">
        <x-input
          name="first_name"
          :value="old('first_name')"
          :label="__('general/attributes.first_name')"
          required
        />
        <x-input
          name="last_name"
          :value="old('last_name')"
          :label="__('general/attributes.last_name')"
          required
        />
      </div>
      <x-input
        name="email"
        type="email"
        :value="old('email')"
        :label="__('general/attributes.email')"
        required
      />
      <x-input name="type" :label="__('general/attributes.ticket_type')" type="select" required>
        <option></option>
        @foreach($types as $type)
          <option>{{ $type->type }}</option>
        @endforeach
      </x-input>
      <x-input
        name="subject"
        :value="old('subject')"
        :label="__('general/attributes.subject')"
        required
      />
      <x-input
        name="description"
        type="textarea"
        :value="old('description')"
        :label="__('general/attributes.description')"
        required
      />
      <button type="submit" class="button" name="ticket">
        {{ __('views/ticket.submit') }}
      </button>
    </form>
  </div>
@endsection
