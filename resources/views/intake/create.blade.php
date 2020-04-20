@extends('layouts.app')

@section('title', __('views/intakes.title_create'))

@section('content')
  <div class="content">
    <h1 class="page-heading" dusk="title">
      {{ __('views/intakes.title_create') }}
    </h1>
    <x-errors/>
    <form method="post" action="{{ route('intakes.store') }}">
      @csrf
      <div class="two-columns">
        <x-input
          name="invitee"
          type="select"
          :label="__('views/intakes.invitee')"
          required
        >
          @foreach($invitees as $invitee)
            <option value="{{ $invitee->id }}">{{ $invitee->getFullName() }}</option>
          @endforeach
        </x-input>
        <x-input
          name="date"
          type="datetime-local"
          :label="__('views/intakes.date')"
          required
        />
      </div>
      <button class="button" type="submit" name="create">
        {{ __('general/attributes.create') }}
      </button>
    </form>
  </div>
@endsection
