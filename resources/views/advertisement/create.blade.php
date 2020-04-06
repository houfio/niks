@extends('layouts.app')

@section('title', 'Advertentie aanmaken')

@section('content')
  <div class="content">
    <h1 class="page-heading" dusk="title">
      Advertentie aanmaken
    </h1>
    <x-errors/>
    <form method="post" action="{{ route('advertisements.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="two-columns">
        <x-input
          name="title"
          :label="__('general/attributes.title')"
          :help="__('views/advertisements.title_help')"
          required
        />
        <x-input
          name="short_description"
          :label="__('general/attributes.short_description')"
          :help="__('views/advertisements.short_description_help')"
          required
        />
        <x-input
          name="price"
          type="number"
          :label="__('general/attributes.price')"
          :help="__('views/advertisements.price_help')"
        />
        <x-input
          name="minimum_price"
          type="number"
          :label="__('general/attributes.minimum_price')"
          :help="__('views/advertisements.minimum_price_help')"
        />
      </div>
      <x-input
        name="long_description"
        type="textarea"
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
          <option value="0">Product</option>
          <option value="1">Dienst</option>
        </x-input>
      </div>
      <div class="checkbox-input">
        <input type="checkbox" id="enable_bidding" name="enable_bidding" value="0">
        <label for="enable_bidding">{{ __('general/attributes.enable_bidding') }}</label>
      </div>
      <div class="checkbox-input">
        <input type="checkbox" id="asking" name="asking" value="0">
        <label for="asking">{{ __('general/attributes.asking') }}</label>
      </div>
      <button class="button" type="submit" name="create">
        {{ __('general/attributes.create') }}
      </button>
    </form>
  </div>
@endsection
