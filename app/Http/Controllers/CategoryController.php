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
        ]);

        Category::create($category);
        \Toastr::success('Successfully added category', null, ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }

    public function destroy(Category $category)
    {
        $category->delete();
        \Toastr::error('Category has been deleted', null, ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }
}