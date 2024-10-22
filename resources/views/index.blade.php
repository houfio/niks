@extends('layouts.app')

@section('title', __('views/news.title'))

@section('content')
  @if(count($posts))
    <div class="content">
      <h1 class="page-heading">
        {{ __('views/home.title') }}
      </h1>
    </div>
    <x-errors/>
    @foreach($posts as $post)
      <div class="advertisement">
        <div class="advertisement-header">
          <div>
            <h2>
              {{ $post->title }}
            </h2>
            <div class="subtle">
              {{ $post->author->getFullName() }} - {{ $post->created_at->diffForHumans() }}
            </div>
          </div>
        </div>
        <div class="categories">
          @foreach($post->categories as $category)
            <div>
              {{ $category->category }}
            </div>
          @endforeach
        </div>
        <div class="advertisement-description">
          {{ $post->content }}
        </div>
        @if(isset($post->header))
          <div>
            <img src="{{ $post->header->url() }}" class="image"/>
          </div>
        @endif
        <div style="display: flex">
          @can('update', $post)
            <a class="button light small" href="{{ action('PostController@edit', ['post' => $post]) }}">
              {{ __('views/posts.update') }}
            </a>
          @endcan
          @can('delete', $post)
            <form method="post" action="{{ @action('PostController@destroy', ['post' => $post]) }}">
              @csrf
              @method('delete')
              <button type="submit" class="button danger small">
                {{ __('views/posts.delete') }}
              </button>
            </form>
          @endcan
        </div>
      </div>
    @endforeach
    {{ $posts->links() }}
  @else
    <x-errors/>
    <x-empty icon="newspaper">
      {{ __('views/news.empty') }}
    </x-empty>
  @endif
@endsection

@section('sidebar')
  <div class="sidebar">
    @can('create', \App\Post::class)
      <a class="button" href="{{ action('PostController@create') }}">
        {{ __('views/posts.create') }}
      </a>
    @endcan
    <form method="get" action="{{ @action('PostController@index') }}" style="margin-top: 1rem">
      <x-input name="search" :label="__('views/posts.search')" light/>
      <x-category :children="$categories" :depth="0"/>
      <button class="button" type="submit" dusk="search">
        {{ __('views/advertisements.search') }}
      </button>
    </form>
  </div>
@endsection

@section('scripts')
  <script src="{{ mix('/js/tree.js') }}"></script>
@endsection
