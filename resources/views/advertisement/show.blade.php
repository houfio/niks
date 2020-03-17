@extends('layouts.app')

@section('title', 'Ad bekijken')

@section('content')
  <div class="content">
    <span>
      <button>Terug</button>
    </span>
    <h1 class="page-heading">
      {{ $advertisement->title }}
    </h1>
    <span class="advertisement-info">
        <span class="made-by"> Gemaakt door: {{ $user->first_name }} {{ $user->last_name }} </span>
        <span class="create-date"> Gemaakt op: {{ $advertisement->created_at }}</span>
        @if($advertisement->asking)
        <span class="asking"> Vraagt aan </span>
      @else
        <span class="asking"> Biedt aan </span>
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
        <button type="button"> Bieden</button>
      @endif
    </h3>
    <h4>
      Beschrijving
    </h4>
      {{ $advertisement->long_description }}
    </p>
  </div>
@endsection
