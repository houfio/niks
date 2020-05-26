@extends('layouts.app')

@section('theme', 'dark')

@section('title', __('views/advertisements.title_create'))

@section('content')
  <div class="content">
    <h1 class="page-heading" dusk="title">
      {{ __('views/category.title_create') }}
    </h1>
    <x-errors/>
    <form method="post" action="{{ @action('CategoryController@update', ['category' => $category]) }}">
      @method('put')
      @csrf
      <div>
        <x-input
          name="category"
          :label="__('general/attributes.category_name')"
          :value="$category->category"
          :help="__('views/category.category_name_help')"
          required
        />
      </div>
      <div class="two-columns">
        <x-input
          name="parent"
          type="select"
          :label="__('views/category.parent')"
        >
          <option value="0">{{ __('general/attributes.none') }}</option>
          <x-select-category :children="$categories" :category="$category" :depth="0"/>
        </x-input>

        <x-input
          name="type"
          type="select"
          :label="__('general/attributes.applied_to')"
        >
          <option value="advertisement" @if($category->type == "advertisement") selected @endif>{{ __('general/attributes.advertisement') }}</option>
          <option value="post" @if($category->type == "post") selected @endif>{{ __('general/attributes.post') }}</option>
        </x-input>
      </div>
      <button class="button" type="submit" name="create">
        {{ __('general/attributes.edit') }}
      </button>
    </form>
  </div>
@endsection

@section('scripts')
  <script src="{{ mix('/js/form.js') }}"></script>
@endsection
