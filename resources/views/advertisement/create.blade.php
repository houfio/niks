@extends('layouts.app')

@section('title', 'Advertentie aanmaken')

@section('content')
  <div class="content">
    <span>
      <button>Terug</button>
    </span>
    <h1 class="page-heading" dusk="title">
      Advertentie aanmaken
    </h1>
    <x-errors/>
    <form method="post" action="{{ route('advertisements.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="two-columns">
        <div class="text-input">
          <label for="title">{{ __('validation.attributes.title') }}</label>
          <input type="text" id="title" name="title" value="{{ old('title') }}" required/>
        </div>
        <div class="text-input">
          <label for="price">{{ __('validation.attributes.price') }}</label>
          <input type="number" id="price" name="price" value="{{ old('price') }}" required/>
        </div>
        <div class="text-input">
          <label for="minimum_price">{{ __('validation.attributes.minimum_price') }}</label>
          <input type="number" id="minimum_price" name="minimum_price" value="{{ old('minimum_price') }}" required/>
        </div>
        <div class="text-input">
          <label for="short_description">{{ __('validation.attributes.short_description') }}</label>
          <input type="text" id="short_description" name="short_description" value="{{ old('short_description') }}"
                 required/>
        </div>
      </div>
      <div class="text-input">
        <label for="long_description">{{ __('validation.attributes.long_description') }}</label>
        <textarea id="long_description" rows="6" name="long_description">{{ old('long_description') }}</textarea>
      </div>
      <div class="text-input">
        <input type="file" id="images" name="images[]" multiple>
        <label for="images">{{ __('validation.attributes.images') }}</label>
      </div>
      <div class="select-input">
        <select name="is_service">
          <option value="0">Product</option>
          <option value="1">Dienst</option>
        </select>
      </div>
      <div class="checkbox-input">
        <input type="checkbox" id="enable_bidding" name="enable_bidding" value="0">
        <label for="enable_bidding">{{ __('validation.attributes.enable_bidding') }}</label>
      </div>
      <div class="checkbox-input">
        <input type="checkbox" id="asking" name="asking" value="0">
        <label for="asking">{{ __('validation.attributes.asking') }}</label>
      </div>
      <button class="button" type="submit" name="create">
        {{ __('validation.attributes.create') }}
      </button>
    </form>
  </div>
@endsection