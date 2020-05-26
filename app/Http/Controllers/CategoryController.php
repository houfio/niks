<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }

    public function index()
    {
        return view('category.index', [
            'categories' => Category::getAllCategories()
        ]);
    }

    public function create()
    {
        return view('category.create', [
            'advertisement' => Category::getAdvertisementCategories(),
            'post' => Category::getPostCategories()
        ]);
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        $category = new Category();
        $category->category = $data['title'];

        if (is_numeric($data['category'])) {
            $category->parent()->associate(Category::find($data['category']));
        } else {
            $category->type = $data['category'];
        }

        $category->save();

        $request->session()->flash('message', __('messages/category.sent'));
        return redirect()->action('CategoryController@index');
    }


    public function edit(Category $category)
    {
        return view('category.update', [
            'category' => $category,
            'advertisement' => Category::getAdvertisementCategories(),
            'post' => Category::getPostCategories()
        ]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        $category->category = $data['title'];

        if (is_numeric($data['category'])) {
            $category->parent()->associate(Category::find($data['category']));
            $category->type = null;
        } else {
            $category->type = $data['category'];
            $category->parent()->dissociate();
        }

        $category->save();

        $request->session()->flash('message', __('messages/category.updated'));
        return redirect()->action('CategoryController@index');
    }

    public function destroy(Request $request, Category $category)
    {
        $category->children()->update([
            'type' => $category->type,
            'parent_id' => $category->parent->id ?? null
        ]);

        $category->delete();

        $request->session()->flash('message', __('messages/category.deleted'));
        return redirect()->action('CategoryController@index');
    }
}
