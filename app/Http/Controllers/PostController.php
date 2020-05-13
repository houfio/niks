<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    public function index()
    {
        return view('post.index', [
            'posts' => Post::paginate()
        ]);
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(PostRequest $request)
    {
        $data = $request->validated();

        $post = new Post();
        $header = new Asset();

        $post->title = $data['title'];
        $post->content = $data['content'];
        $header->path = $data['header']->store('public');

        $post->author()->associate($request->user());
        $post->header()->associate($header);

        $header->save();
        $post->save();
        $request->session()->flash('message', __('messages/post.sent'));

        return redirect()->action('PostController@index');
    }

    public function show(Post $post)
    {
        return view('post.show', [
            'post' => $post,
            'creator' => $post->author()->get()
        ]);
    }

    public function edit(Post $post)
    {
        return view('post.update', [
            'post' => $post
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $data = $request->validated();
        $header = new Asset();

        $post->title = $data['title'];
        $post->content = $data['content'];
        $header->path = $data['header']->store('public');

        $post->header()->delete();
        $post->header()->associate($header);

        $header->save();
        $post->save();
        $request->session()->flash('message', __('messages/post.updated'));

        return redirect()->route('posts.show', $post->id);
    }

    public function destroy(Request $request, Post $post)
    {
        $post->delete();
        $request->session()->flash('message', __('messages/post.deleted'));

        return redirect()->action('PostController@index');
    }
}
