@extends('layouts.app')

@section('theme', 'dark')

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
      <div data-href="{{ url("/intakes/$intake->id") }}">
        {{ $intake->invitee->getFullName() }}
        {{ $intake->date->isoFormat('LLLL') }}

        @if(!$intake->accepted)
          <form action="{{ @action('IntakeController@destroy', ['intake' => $intake]) }}" method="post">
            @csrf
            @method('delete')
            <button class="button" type="submit">
              {{ __('views/intakes.delete') }}
            </button>
          </form>
        @endif
      </div>
    @endforeach

    <form action="{{ @action('IntakeController@create') }}" method="get">
      <button class="button" type="submit">
        {{ __('general/attributes.create') }}
      </button>
    </form>
  @else
    <x-errors/>
    <x-empty icon="calendar-alt">
      {{ __('views/intakes.empty') }}
    </x-empty>
  @endif
@endsection
