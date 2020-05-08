@extends('layouts.app')

@can('edit-all')
  @section('theme', 'dark')
@endcan

@section('title', __('views/intakes.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('views/intakes.individual_title') }} - {{ $intake->invitee->getFullName() }}
    </h1>
    <x-errors/>
    <x-input
      name="inviter"
      :label="__('views/intakes.inviter')"
      :value="$intake->inviter->getFullName()"
      disabled
    />
    <x-input
      name="invitee"
      :label="__('views/intakes.invitee')"
      :value="$intake->invitee->getFullName()"
      disabled
    />
    <x-input
      name="date"
      :label="__('views/intakes.date')"
      :value="$intake->date->isoFormat('LLLL')"
      disabled
    />
    <div class="checkbox-input">
      <input
        type="checkbox"
        id="accepted"
        name="accepted"
        @if($intake->accepted) checked @endif
        disabled
      />
      <label for="accepted">
        {{ __('views/intakes.accepted') }}
      </label>
    </div>
  </div>
@endsection
