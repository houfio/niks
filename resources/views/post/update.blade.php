@extends('layouts.app')

@section('theme', 'dark')

@section('title', __('views/posts.title'))

@section('content')
  <div class="content">
    <h1 class="page-heading" dusk="title">
      {{ __('views/posts.title_create') }}
    </h1>
    <x-errors/>
    <form method="post" action="{{ @action('PostController@store') }}" enctype="multipart/form-data">
      @csrf
      <x-input
        name="title"
        :value="$post->title"
        :label="__('general/attributes.title')"
        :help="__('views/posts.title_help')"
        required
      />
      <x-input
        name="content"
        type="textarea"
        :value="$post->content"
        :label="__('general/attributes.content')"
        :help="__('views/posts.content_help')"
        required
      />
      <x-input
        name="header"
        type="file"
        :label="__('general/attributes.image')"
        :help="__('views/posts.image_help')"
      />
      <button class="button" type="submit">
        {{ __('views/posts.update') }}
      </button>
    </form>
  </div>
@endsection
