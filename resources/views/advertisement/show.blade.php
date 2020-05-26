@extends('layouts.app')

@section('title', __('advertisement.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading" dusk="title">
      {{ $advertisement->title }}
      <x-icon-action
        :action="action($favorite ? 'UserFavoritesController@destroy' : 'UserFavoritesController@store', $favorite ? ['favorite' => $favorite] : ['advertisement' => $advertisement])"
        icon="heart"
        :method="$favorite ? 'delete' : 'post'"
        :class="'heart' . ($favorite ? ' active' : '')"
        :duskSelector="'favorite_button'"
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
        <div class="text-input light">
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
    <a href="{{ action('UserController@show', ['user' => $user]) }}">
      {{ $user->getFullName() }}
    </a>
    <div class="subtle" title="{{ $advertisement->created_at->isoFormat('LLLL') }}">
      {{ $advertisement->created_at->diffForHumans() }}
    </div>
    @can('delete', $advertisement)
      <button type="button" class="button light small" data-micromodal-trigger="delete-modal">
        {{ __('views/advertisements.delete') }}
      </button>
      <form method="post" action="{{ @action('AdvertisementController@destroy', ['advertisement' => $advertisement]) }}" id="deleteForm">
        @csrf
        @method('delete')
        <x-modal id="delete" :title="__('views/advertisements.delete')">
          <p>
            {{ __('views/advertisements.delete_advertisement') }}
          </p>
          <div class="button-group">
            <button type="button" class="button danger" id="deleteSubmit">{{ __('views/advertisements.confirm') }}</button>
            <button
              type="button"
              class="button light"
              data-micromodal-close
            >
              {{ __('views/advertisements.cancel') }}
            </button>
          </div>
        </x-modal>
      </form>
    @endcan
    @can('update', $advertisement)
      <a dusk="edit_advertisement" class="button light small" href="{{ @action('AdvertisementController@edit', ['advertisement' => $advertisement]) }}">
        {{ __('general/attributes.edit') }}
      </a>
    @endcan
  </div>
@endsection

@section('scripts')
  <script src="{{ mix('/js/confirm.js') }}"></script>
@endsection
