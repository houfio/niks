@extends('layouts.app')

@can('before', \App\User::class)
  @section('theme', 'dark')
@endcan

@section('title', __('views/intakes.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('views/intakes.individual_title') }} - {{ $intake->invitee->getFullName() }}
    </h1>
  </div>
  <x-errors/>
  <div>
    {{ __('views/intakes.inviter') }}:
    {{ $intake->invitee->getFullName() }}
  </div>
  <div>
    {{ __('views/intakes.invitee') }}:
    {{ $intake->inviter->getFullName() }}
  </div>
  <div>
    {{ __('views/intakes.date') }}:
    {{ $intake->date }}
  </div>
  <div>
    {{ __('views/intakes.accepted') }}:
    {{ $intake->accepted ? __('views/intakes.yes') : __('views/intakes.no') }}
  </div>
@endsection
