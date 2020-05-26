<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Category;
use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    public function index(Request $request)
    {
        $queries = $request->query();
        $posts = Post::query();

        if (isset($queries['search'])) {
            $posts = $posts->where(function ($query) use ($queries) {
                $query->where('title', 'like', "%{$queries['search']}%")
                    ->orWhere('content', 'like', "%{$queries['search']}%");
            });
        }

        if (isset($queries['categories'])) {
            $categories = $queries['categories'];
            $categories = Category::whereIn('id', $categories)->get();
            $categoryIds = [];

            foreach ($categories as $category) {
                $categoryIds[] = $category->id;

                foreach ($category->children()->get()->pluck('id')->toArray() as $subCategory) {
                    $categoryIds[] = $subCategory;
                }
            }

            $posts->whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('categories.id', $categoryIds);
            });
        }

        return view('index', [
            'posts' => $posts->orderBy('created_at', 'desc')->paginate(),
            'categories' => Category::getPostCategories()
        ]);
    }

    public function create()
    {
        return view('post.create', [
            'categories' => Category::getPostCategories()
        ]);
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
        $post->categories()->attach($data['categories'] ?? []);

        $post->save();
        $request->session()->flash('message', __('messages/post.sent'));

        return redirect()->action('PostController@index');
    }

    public function edit(Post $post)
    {
        return view('post.update', [
            'post' => $post,
            'categories' => Category::getPostCategories()
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

        $post->categories()->sync($data['categories'] ?? []);

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
