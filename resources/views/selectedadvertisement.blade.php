@extends('layouts.app')

@section('title', 'Lokale Ruilkring \'s-Hertogenbosch')

@section('content')
  <div class="content">
    <span>
      <button>Terug</button>
    </span>
    <ul>

      @foreach($advertisement as $i)
        <h1 class="page-heading">
          {{$i-> title}}
        </h1>
        <span class="advertisement-info">
          <span class="made-by"> Gemaakt door: {{$user[0]->first_name}} {{$user[0]->last_name}} </span>
          <span class="create-date"> Gemaakt op: {{$i->created_at}}</span>
        </span>
        <div>
          <img src="{{$i-> path}}" class="w3-round" height="200" width="200" />
        </div>
        <h3>
          Prijs : {{$i-> price}} niks
          @if($i->enable_bidding === 1)
          <button type="button"> Bieden </button>
          @endif
        </h3>
        <h4>
          Beschrijving
        </h4>
          {{$user}}
          {{$i-> long_description}}
        </p>

        <li>{{$i}}</li>
      @endforeach
    </ul>
  </div>
@endsection
