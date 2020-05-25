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
        return view('index', [
            'posts' => Post::orderBy('created_at', 'desc')->paginate()
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

        $post->title = $data['title'];
        $post->content = $data['content'];

        if ($request->hasFile('header')) {
            $header = new Asset();

            $header->path = $data['header']->store('public');

            $header->save();
            $post->header()->associate($header);
        }

        $post->author()->associate($request->user());

        $post->save();
        $request->session()->flash('message', __('messages/post.sent'));

        return redirect()->action('PostController@index');
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

        $post->title = $data['title'];
        $post->content = $data['content'];

        if ($request->hasFile('header')) {
            $header = new Asset();

            $header->path = $data['header']->store('public');

            $post->header()->delete();
            $post->header()->associate($header);
            $header->save();
        }

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
