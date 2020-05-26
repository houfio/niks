@extends('layouts.app')

@section('theme', 'dark')

@section('title', __('views/advertisements.title_create'))

@section('content')
  <div class="content">
    <h1 class="page-heading" dusk="title">
      {{ __('views/category.title_create') }}
    </h1>
    <x-errors/>
    <form method="post" action="{{ @action('CategoryController@store') }}">
      @csrf
      <div>
        <x-input
          name="category"
          :label="__('general/attributes.category_name')"
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
          <x-select-category :children="$categories" :depth="0"/>
        </x-input>

        <x-input
          name="type"
          type="select"
          :label="__('general/attributes.applied_to')"
        >
          <option value="advertisement">{{ __('general/attributes.advertisement') }}</option>
          <option value="post">{{ __('general/attributes.post') }}</option>
        </x-input>
      </div>
      <button class="button" type="submit" name="create">
        {{ __('general/attributes.create') }}
      </button>
    </form>
  </div>
@endsection

@section('scripts')
  <script src="{{ mix('/js/form.js') }}"></script>
@endsection
