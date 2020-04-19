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
        {{ $intake->invitee->getFullName() }}
        {{ $intake->date }}

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
  @else
    <x-errors/>
    <x-empty icon="calendar-alt">
      {{ __('views/intakes.empty') }}
    </x-empty>
  @endif
@endsection
