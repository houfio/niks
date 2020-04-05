@extends('layouts.app')

@section('title', __('views/advertisements.title'))

@section('content')
  @if(count($advertisements))
    <div class="content">
      <h1 class="page-heading">
        {{ __('views/advertisements.title') }}
      </h1>
    </div>
    <x-errors/>
    @foreach($advertisements as $advertisement)
      <div class="advertisement" data-href="{{ url("/advertisements/$advertisement->id") }}">
        <h2>
          {{ $advertisement->title }}
        </h2>
        <div class="subtle">
          {{ $advertisement->user->getFullName() }} - {{ $advertisement->created_at->diffForHumans() }}
        </div>
        <div class="advertisement-description">
          {{ $advertisement->short_description }}
        </div>
        @if(count($advertisement->assets) > 0)
          <div>
            <img src="{{ $advertisement->assets->first()->path }}" class="image"/>
          </div>
        @endif
      </div>
    @endforeach
    {{ $advertisements->links() }}
  @else
    <x-errors/>
    <x-empty icon="store">
      Er zijn nog geen advertenties
    </x-empty>
  @endif
@endsection

@section('sidebar')
  <div class="sidebar">
    <a class="button" href="{{ url('/advertisements/create') }}">
      Aanmaken
    </a>
  </div>
@endsection
