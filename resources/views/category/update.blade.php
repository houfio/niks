@extends('layouts.app')

@section('theme', 'dark')

@section('title', __('views/categories.update'))

@section('content')
  <div class="content">
    <h1 class="page-heading" dusk="title">
      {{ __('views/categories.update') }}
    </h1>
    <x-errors/>
    <form method="post" action="{{ @action('CategoryController@update', ['category' => $category]) }}">
      @method('put')
      @csrf
      <x-input
        name="title"
        :value="$category->category"
        :label="__('general/attributes.category_name')"
        :help="__('views/categories.category_name_help')"
        required
      />
      <div class="two-columns">
        <div class="checkbox-input">
          <input
            type="radio"
            id="category_advertisement"
            value="advertisement"
            name="category"
            @if($category->type === 'advertisement') checked @endif
          />
          <label for="category_advertisement">
            {{ __('views/categories.advertisement') }}
          </label>
        </div>
        <div>
          <x-category
            :children="$advertisement"
            :depth="0"
            single
            :disable="$category->id"
            :current="$category->parent->id ?? null"
          />
        </div>
        <div class="checkbox-input">
          <input
            type="radio"
            id="category_post"
            value="post"
            name="category"
            @if($category->type === 'post') checked @endif
          />
          <label for="category_post">
            {{ __('views/categories.post') }}
          </label>
        </div>
        <div>
          <x-category
            :children="$post"
            :depth="0"
            single
            :disable="$category->id"
            :current="$category->parent->id ?? null"
          />
        </div>
      </div>
      <button class="button" type="submit" name="create">
        {{ __('general/attributes.edit') }}
      </button>
    </form>
  </div>
@endsection

@section('scripts')
  <script src="{{ mix('/js/tree.js') }}"></script>
@endsection
