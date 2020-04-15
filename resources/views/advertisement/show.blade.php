@extends('layouts.app')

@section('title', __('advertisement.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading" dusk="title">
      {{ $advertisement->title }}
      <x-icon-action
        :action="action('UserFavoritesController@store', ['advertisement' => $advertisement])"
        icon="heart"
        class="heart {{ $advertisement->favoritedBy->contains(Auth::user()) ? 'active' : '' }}"
      />
    </h1>
    <x-errors/>
    @if(count($assets) > 0)
      <div>
        <img src="{{ $assets->first()->url() }}" class="image"/>
      </div>
    @endif
    <p dusk="description">
      {{ $advertisement->long_description }}
    </p>
  </div>
@endsection

@section('sidebar')
  <div class="sidebar">
    @if($advertisement->enable_bidding)
      <div class="bids">
        @forelse($bids as $bid)
          <div class="bid">
            {{ $bid->user->first_name }}
            <div class="spacer"></div>
            <span class="price">
              {{ $bid->bid }}
            </span>
            @can('delete', $bid)
              <x-icon-action
                :action="action('BidController@destroy', ['bid' => $bid->id])"
                method="delete"
                :duskSelector="'delete_bid_' . $bid->id"
                icon="times"
              />
            @endcan
          </div>
        @empty
          {{ __('views/advertisements.no_bids') }}
        @endforelse
      </div>
      <form method="post" action="{{ @action('BidController@store', ['advertisement' => $advertisement->id]) }}">
        @csrf
        <div class="text-input white">
          <label for="bid">{{ __('general/attributes.bid') }}</label>
          <input type="number" id="bid" name="bid" required/>
        </div>
        <button type="submit" class="button" name="place_bid">
          {{ __('views/advertisements.bid') }}
        </button>
      </form>
    @else
      {{ $advertisement->price }} niksen
      <div class="subtle">
        {{ __('views/advertisements.no_bidding') }}
      </div>
    @endif
  </div>
  <div class="sidebar-footer">
    <div>{{ $user->first_name }} {{ $user->last_name }}</div>
    <div class="subtle" title="{{ $advertisement->created_at->isoFormat('LLLL') }}">
      {{ $advertisement->created_at->diffForHumans() }}
    </div>
    @can('delete', $advertisement)
      <form
        method="post"
        action="{{ @action('AdvertisementController@destroy', ['advertisement' => $advertisement]) }}"
      >
        @csrf
        @method('delete')
        <button type="submit" class="button transparent" style="margin-top: 1rem">
          {{ __('views/advertisements.delete') }}
        </button>
      </form>
    @endcan
  </div>
@endsection
