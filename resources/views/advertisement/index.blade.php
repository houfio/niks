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
      <x-advertisement :advertisement="$advertisement"/>
    @endforeach
    {{ $advertisements->links() }}
  @else
    <x-errors/>
    <x-empty icon="store">
      {{ __('views/advertisements.empty') }}
    </x-empty>
  @endif
@endsection

@section('sidebar')
  <div class="sidebar">
    <a class="button" href="{{ url('/advertisements/create') }}">
      {{ __('views/advertisements.create') }}
    </a>
    <form method="get" action="{{ @action('AdvertisementController@index') }}" style="margin-top: 1rem">
      <x-input name="search" :label="__('views/advertisements.search')" light/>
      <x-input name="price" :label="__('views/advertisements.price')" type="number" light/>
      <x-input name="distance" :label="__('views/advertisements.distance')" type="select" light>
        <option></option>
        @foreach(['5', '10', '15'] as $distance)
          <option @if(request()->get('distance') === $distance) selected @endif>{{ $distance }}</option>
        @endforeach
      </x-input>
      <div class="checkbox-input light">
        <input
          type="checkbox"
          id="bidding"
          name="bidding"
          @if(request()->get('bidding')) checked @endif
        />
        <label for="bidding">
          {{ __('views/advertisements.bid') }}
        </label>
      </div>
      <button class="button" type="submit" dusk="search">
        {{ __('views/advertisements.search') }}
      </button>
    </form>
  </div>
@endsection
