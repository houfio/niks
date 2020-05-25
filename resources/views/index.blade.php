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

@can('create', \App\Post::class)
@section('sidebar')
  <div class="sidebar">
    <a class="button" href="{{ action('PostController@create') }}">
      {{ __('views/posts.create') }}
    </a>
  </div>
@endsection
@endcan
