@extends('layouts.app')

@can('edit-all')
  @section('theme', 'dark')
@endcan

@section('title', __('views/interview.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('views/interview.individual_title') }} - {{ $interview->invitee->getFullName() }}
    </h1>
    <x-errors/>
    <x-input
      name="inviter"
      :label="__('views/interview.inviter')"
      :value="$interview->inviter->getFullName()"
      disabled
    />
    <x-input
      name="invitee"
      :label="__('views/interview.invitee')"
      :value="$interview->invitee->getFullName()"
      disabled
    />
    <x-input
      name="date"
      :label="__('views/interview.date')"
      :value="$interview->date->isoFormat('LLLL')"
      disabled
    />
    <div class="checkbox-input">
      <input
        type="checkbox"
        id="accepted"
        name="accepted"
        @if($interview->accepted) checked @endif
        disabled
      />
      <label for="accepted">
        {{ __('views/interview.accepted') }}
      </label>
    </div>
  </div>
@endsection
