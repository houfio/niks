@extends('layouts.app')

@section('title', 'Advertentie aanpassen')

@section('content')
  <div class="content">
    <h1 class="page-heading" dusk="title">
      Advertentie aanpassen
    </h1>
    <x-errors/>
    <form method="post" action="{{ @action('AdvertisementController@update', ['advertisement' => $advertisement]) }}" enctype="multipart/form-data">
      @csrf
      @method('put')
      <div class="two-columns">
        <x-input
          name="title"
          :label="__('general/attributes.title')"
          :value="$advertisement->title"
          :help="__('views/advertisements.title_help')"
          required
        />
        <x-input
          name="short_description"
          :label="__('general/attributes.short_description')"
          :value="$advertisement->short_description"
          :help="__('views/advertisements.short_description_help')"
          required
        />
        <x-input
          name="price"
          type="number"
          :label="__('general/attributes.price')"
          :value="$advertisement->price"
          :help="__('views/advertisements.price_help')"
        />
        <x-input
          name="minimum_price"
          type="number"
          :label="__('general/attributes.minimum_price')"
          :value="$advertisement->minimum_price"
          :help="__('views/advertisements.minimum_price_help')"
        />
      </div>
      <x-input
        name="long_description"
        type="textarea"
        :value="$advertisement->long_description"
        :label="__('general/attributes.long_description')"
      />
      <div class="two-columns">
        <x-input
          name="images[]"
          type="file"
          :label="__('general/attributes.images')"
          multiple
        />
        <x-input
          name="is_service"
          type="select"
          :label="__('general/attributes.is_service')"
        >
          <option value="0" @if(!$advertisement->is_service) selected @endif>Product</option>
          <option value="1" @if($advertisement->is_service) selected @endif>Dienst</option>
        </x-input>
      </div>
      <div class="checkbox-input">
        <input type="checkbox" id="enable_bidding" name="enable_bidding" @if($advertisement->enable_bidding) checked @endif>
        <label for="enable_bidding">{{ __('general/attributes.enable_bidding') }}</label>
      </div>
      <div class="checkbox-input">
        <input type="checkbox" id="is_asking" name="is_asking" @if($advertisement->is_asking) checked @endif>
        <label for="is_asking">{{ __('general/attributes.is_asking') }}</label>
      </div>
      <button class="button" type="submit" name="edit">
        {{ __('general/attributes.edit') }}
      </button>
    </form>
  </div>
@endsection
