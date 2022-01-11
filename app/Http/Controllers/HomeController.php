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
    public function index(Request $request)
    {
        if (isset($_GET['searchText'])) {

            $itemQuery = Item::query();
            $itemQuery->with('user');
            $search = $_GET['searchText'];

            $itemQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orwhereHas('user', function ($que) use ($search) {
                        $que->where('first_name', 'like', '%' . $search . '%')
                            ->orWhere('last_name', 'like', '%' . $search . '%');
                    });
            });

            $itemQuery->where('active', 1);
            $items = $itemQuery->orderByDesc('created_at')->paginate(9);
        }

        if (empty($_GET['searchText'])) {
            $items = Item::where('active', 1)->orderByDesc('created_at')->paginate(9);
        }

        $categories = Category::orderBy('name')->get();
        return view('home', ['items' => $items, 'categories' => $categories]);
    }

    public function show($slug)
    {
        $category = Category::findBySlugOrFail($slug);
        $items = Item::where('category_id', $category->id)->paginate(9);
        $categories = Category::orderBy('name')->get();
        return view('home', ['items' => $items, 'categories' => $categories, 'category' => $category]);
    }
}