<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $itemQuery = Item::query();
        // $itemQuery->with('user', 'offers');

        // $search = $request->header('searchText');
        // $itemQuery->where(function ($query) use ($search) {
        //     $query->where('name', 'like', '%' . $search . '%')
        //         ->orWhere('description', 'like', '%' . $search . '%')
        //         ->orwhereHas('user', function ($que) use ($search) {
        //             $que->where('first_name', 'like', '%' . $search . '%')
        //                 ->orWhere('last_name', 'like', '%' . $search . '%');
        //         });
        // });

        // $itemQuery->where('active', 1);
        // $items = $itemQuery->orderByDesc('created_at')->get();

        $items = Item::orderBy('created_at', 'desc')->paginate(20);
        $categories = Category::orderBy('name')->get();
        return view('home', ['items' => $items, 'categories' => $categories]);
    }

    public function show(Category $category)
    {
        $items = Item::all();
        return view('home', compact('items'));
    }
}