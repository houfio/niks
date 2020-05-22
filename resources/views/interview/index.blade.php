@extends('layouts.app')

@section('theme', 'dark')

@section('title', __('views/interview.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading">
      {{ __('views/interview.title') }}
    </h1>
  </div>
  <x-errors/>
  @foreach($interviews as $interview)
    <div class="list-item" data-href="{{ url("/interviews/$interview->id") }}">
      {{ $interview->invitee->getFullName() }}
      {{ $interview->date->isoFormat('LLLL') }}
      <div class="spacer"></div>
      @if(!$interview->accepted)
        <form action="{{ @action('InterviewController@destroy', ['interview' => $interview]) }}" method="post">
          @csrf
          @method('delete')
          <button dusk="delete_interview_{{ $interview->id }}" class="button" type="submit">
            <i class="fas fa-trash"></i>
          </button>
        </form>
      @endif
    </div>
  @endforeach
@endsection

@section('sidebar')
  <div class="sidebar">
    <a dusk="create_interview" class="button" href="{{ action('InterviewController@create') }}">
      {{ __('general/attributes.create') }}
    </a>
  </div>
@endsection
