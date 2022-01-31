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

    public function show(Request $request, $slug)
    {
        $data = $this->getActiveItemsAction->execute($request, $slug);

        return view('home', ['items' => $data['items'], 'categories' => $data['categories'], 'popularItems' => $data['popularItems'], 'mostExpensiveItems' => $data['mostExpensiveItems']]);
    }

    // public function search(Request $request)
    // {
    //     $data = $this->getActiveItemsAction->execute($request);

    //     return view('home', ['items' => $data['items'], 'categories' => $data['categories']]);
    // }
}