<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
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

    }

    public function destroy(Request $request, Post $post)
    {
        $post->delete();
        $request->session()->flash('message', __('messages/post.deleted'));

        return redirect()->action('PostController@index');
    }
}
