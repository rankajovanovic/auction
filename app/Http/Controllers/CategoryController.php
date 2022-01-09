<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.categories', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $category = $request->validate([
            'name' => ['required', 'max:255'],
            'slug' => ['required'],
        ]);

        Category::create($category);

        session()->flash('success', 'Successfully added category');
        return redirect()->back();
    }

    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('danger', 'Category has been deleted');

        return redirect()->back();
    }
}