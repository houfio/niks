@extends('layouts.app')

@section('title', __('views/advertisements.edit'))

@section('content')
  <div class="content">
    <h1 class="page-heading" dusk="title">
      {{ __('views/advertisements.edit') }}
    </h1>
    <x-errors/>
    <form
      method="post"
      action="{{ @action('AdvertisementController@update', ['advertisement' => $advertisement]) }}"
      enctype="multipart/form-data"
    >
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
          name="price"
          type="number"
          :label="__('general/attributes.price')"
          :value="$advertisement->price"
          :help="__('views/advertisements.price_help')"
        />
      </div>
      <x-input
        name="short_description"
        :label="__('general/attributes.short_description')"
        :value="$advertisement->short_description"
        :help="__('views/advertisements.short_description_help')"
        required
      />
      <x-input
        name="long_description"
        type="textarea"
        :value="$advertisement->long_description"
        :label="__('general/attributes.long_description')"
      />
      <div class="two-columns">
        @if($assets)
          <button dusk="clear_images" class="button danger" id="delete-images">
            {{ __('views/advertisements.delete_image') }}
          </button>
        @endif
        <x-input
          name="images[]"
          type="file"
          :label="__('general/attributes.images')"
          multiple
        />
        @if($assets)
          <input type="hidden" value="1" name="delete_images">
        @endif
        <x-input
          name="is_service"
          type="select"
          :label="__('general/attributes.is_service')"
        >
          <option value="0" @if(!$advertisement->is_service) selected @endif>
            {{ __('general/attributes.product') }}
          </option>
          <option value="1" @if($advertisement->is_service) selected @endif>
            {{ __('general/attributes.service') }}
          </option>
        </x-input>
          <div class="checkbox-input">
            <input
              type="checkbox"
              id="enable_bidding"
              name="enable_bidding"
              @if($advertisement->enable_bidding) checked @endif
            />
            <label for="enable_bidding">{{ __('general/attributes.enable_bidding') }}</label>
          </div>
          <div class="checkbox-input">
            <input type="checkbox" id="is_asking" name="is_asking" @if($advertisement->is_asking) checked @endif>
            <label for="is_asking">{{ __('general/attributes.is_asking') }}</label>
          </div>
      </div>
      <button dusk="update" class="button" type="submit" name="edit">
        {{ __('general/attributes.edit') }}
      </button>
    </form>
  </div>
@endsection

@section('scripts')
  <script src="{{ mix('/js/images.js') }}"></script>
@endsection
