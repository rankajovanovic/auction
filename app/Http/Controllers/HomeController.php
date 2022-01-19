<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Actions\ItemActions\GetActiveItemsAction;

class HomeController extends Controller
{

    protected GetActiveItemsAction $getActiveItemsAction;

    public function __construct(GetActiveItemsAction $getActiveItemsAction)
    {
        $this->getActiveItemsAction = $getActiveItemsAction;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $data = $this->getActiveItemsAction->execute($request);

        return view('home', ['items' => $data['items'], 'categories' => $data['categories'], 'popularItems' => $data['popularItems'], 'mostExpensiveItems' => $data['mostExpensiveItems']]);
    }

    public function show($slug)
    {
        $category = Category::findBySlugOrFail($slug);
        $items = Item::where('category_id', $category->id)->where('active', 1)->orderByDesc('created_at')->paginate(9);
        $categories = Category::orderBy('name')->get();

        return view('home', ['items' => $items, 'categories' => $categories, 'category' => $category]);
    }

    // public function search(Request $request)
    // {
    //     $data = $this->getActiveItemsAction->execute($request);

    //     return view('home', ['items' => $data['items'], 'categories' => $data['categories']]);
    // }
}