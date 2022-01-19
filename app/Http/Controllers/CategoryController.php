<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Item;

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
        $items = Item::where('category_id', $category->id)->get();
        foreach ($items as $item) {
            $item->delete();
        }
        $category->delete();
        \Toastr::error('Category has been deleted', null, ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }
}