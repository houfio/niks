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
    <form method="get" action="{{ @action('AdvertisementController@index') }}">
      <x-input name="search" label="Zoeken" white/>
      <x-input name="price" label="Prijs" type="number" white/>
      <x-input name="distance" label="Afstand" type="select" white>
        <option></option>
        <option @if(request()->get('distance') === '5') selected @endif>5</option>
        <option @if(request()->get('distance') === '10') selected @endif>10</option>
        <option @if(request()->get('distance') === '15') selected @endif>15</option>
      </x-input>
      <button class="button" type="submit">
        Submit
      </button>
    </form>
  </div>
@endsection
