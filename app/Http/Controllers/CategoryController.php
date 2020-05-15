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

    }

    public function destroy(Request $request, Category $category)
    {
        $category->delete();

        $request->session()->flash('message', __('messages/category.deleted'));
        return redirect()->action('CategoryController@index');
    }
}
