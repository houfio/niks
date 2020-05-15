<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = new Category();
        $categories = $categories->getChildren();

        return view('category.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        $category = new Category();
        $category->category = $data['category'];

        if (isset($data['type'])) {
            $category->type = $data['type'];
        } else {
            $category->parent()->associate(Category::find($data['parent']));
        }

        $category->save();

        $request->session()->flash('message', __('messages/category.sent'));
        return redirect()->action('CategoryController@index');
    }

    public function show(Category $category)
    {
        return view('category.show', [
            'category' => $category
        ]);
    }

    public function edit(Category $category)
    {
        return view('category.update', [
            'category' => $category
        ]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        $category->category = $data['category'];

        if (isset($data['type'])) {
            $category->type = $data['type'];
        } else {
            $category->parent()->associate(Category::find($data['parent']));
        }

        $category->save();

        $request->session()->flash('message', __('messages/category.updated'));
        return redirect()->action('CategoryController@edit', $category->id);
    }

    public function destroy(Request $request, Category $category)
    {
        $category->delete();

        $request->session()->flash('message', __('messages/category.deleted'));
        return redirect()->action('CategoryController@index');
    }
}
