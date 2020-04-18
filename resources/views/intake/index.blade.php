@extends('layouts.app')

@section('title', __('views/intakes.title'))

@section('content')
  @if(count($intakes))
    <div class="content">
      <h1 class="page-heading">
        {{ __('views/intakes.title') }}
      </h1>
    </div>
    <x-errors/>
    @foreach($intakes as $intake)
      <div>
        <h3>
          {{ $intake->invitee->getFullName() }}
        </h3>
      </div>
    @endforeach
  @else
    <x-errors/>
    <x-empty icon="calendar-alt">
      {{ __('views/intakes.empty') }}
    </x-empty>
  @endif
@endsection
