@extends('layouts.app')

@section('theme', 'dark')

@section('title', __('views/intakes.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('views/intakes.title') }}
    </h1>
  </div>
  <x-errors/>
  @foreach($intakes as $intake)
    <div class="list-item" data-href="{{ url("/intakes/$intake->id") }}">
      {{ $intake->invitee->getFullName() }}
      {{ $intake->date->isoFormat('LLLL') }}
      <div class="spacer"></div>
      @if(!$intake->accepted)
        <form action="{{ @action('IntakeController@destroy', ['intake' => $intake]) }}" method="post">
          @csrf
          @method('delete')
          <button class="button" type="submit">
            <i class="fas fa-trash"></i>
          </button>
        </form>
      @endif
    </div>
  @endforeach
@endsection

@section('sidebar')
  <div class="sidebar">
    <form action="{{ @action('IntakeController@create') }}" method="get">
      <button class="button" type="submit">
        {{ __('general/attributes.create') }}
      </button>
    </form>
  </div>
@endsection
