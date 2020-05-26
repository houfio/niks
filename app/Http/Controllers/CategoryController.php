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
        $categories = new Category();

        return view('category.index', [
            'categories' => $categories->getAllCategories()
        ]);
    }

    public function create()
    {
        $categories = new Category();

        return view('category.create', [
            'categories' => $categories->getAllCategories()
        ]);
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


    public function edit(Category $category)
    {
        $categories = new Category();

        return view('category.update', [
            'category' => $category,
            'categories' => $categories->getAllCategories()
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
        return redirect()->action('CategoryController@index', $category->id);
    }

    public function destroy(Request $request, Category $category)
    {
        $category->delete();

        $request->session()->flash('message', __('messages/category.deleted'));
        return redirect()->action('CategoryController@index');
    }
}
