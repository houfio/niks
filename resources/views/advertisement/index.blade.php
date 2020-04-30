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
      <x-input name="search" :label="__('views/advertisements.search')" white/>
      <x-input name="price" :label="__('views/advertisements.price')" type="number" white/>
      <x-input name="distance" :label="__('views/advertisements.distance')" type="select" white>
        <option></option>
        <option @if(request()->get('distance') === '5') selected @endif>5</option>
        <option @if(request()->get('distance') === '10') selected @endif>10</option>
        <option @if(request()->get('distance') === '15') selected @endif>15</option>
      </x-input>
      <div class="checkbox-input white">
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
      <button class="button" type="submit">
        {{ __('views/advertisements.search') }}
      </button>
    </form>
  </div>
@endsection
