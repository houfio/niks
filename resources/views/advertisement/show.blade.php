@extends('layouts.app')

@section('title', 'Ad bekijken')

@section('content')
  <div class="content">
    <span>
      <button>Terug</button>
    </span>
    <h1 class="page-heading" dusk="title">
      {{ $advertisement->title }}
    </h1>
    <span class="advertisement-info">
        <span class="made-by">Gemaakt door: {{ $user->first_name }} {{ $user->last_name }}</span>
        <span class="create-date">Gemaakt op: {{ $advertisement->created_at }}</span>
        @if($advertisement->asking)
          <span class="asking">Vraagt aan</span>
        @else
          <span class="asking">Biedt aan</span>
        @endif
    </span>
    <div>
      @foreach($assets as $asset)
        <img src="{{ $asset->path }}" class="w3-round" height="200" width="200"/>
      @endforeach
    </div>
    <h3>
      Prijs : {{ $advertisement->price }} niks
      @if($advertisement->enable_bidding)
        <form method="post" action="{{ @action('BidController@store', ['advertisement' => $advertisement->id]) }}">
          @csrf
          <div class="text-input">
            <label for="bid">Bod:</label>
            <input type="number" id="bid" name="bid" required/>
          </div>
          <button type="submit" class="button" name="place_bid">
            Bieden
          </button>
        </form>
      @endif
    </h3>
    <h4>
      Beschrijving
    </h4>
    <p dusk="description">
      {{ $advertisement->long_description }}
    </p>
    @can('delete', $advertisement)
      <form action="{{ @action('AdvertisementController@destroy', ['advertisement' => $advertisement]) }}">
        @csrf
        @method('delete')
        <button type="submit" class="button">
          Verwijderen
        </button>
      </form>
    @endcan
  </div>
@endsection
