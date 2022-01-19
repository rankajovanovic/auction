<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\Bid;
use App\Models\Category;

class AdminController extends Controller
{

    public function index()
    {
        $countUsers = User::count();
        $countItems = Item::count();
        $countBids = Bid::count();
        $countCategories = Category::count();

        return view('admin.index', compact('countUsers', 'countItems', 'countBids', 'countCategories'));
    }

    public function getItems()
    {
        $items = Item::all();
        // $items = Item::where('active', '=', '1')->get();

        return view('admin.items')->with(['items' => $items]);
    }

    public function attach(User $user)
    {
        $user->roles()->attach(request('role'));
        \Toastr::success('Role attached', null, ["positionClass" => "toast-top-right"]);

        return back();
    }

    public function detach(User $user)
    {
        $user->roles()->detach(request('role'));
        \Toastr::success('Role detached', null, ["positionClass" => "toast-top-right"]);

        return back();
    }
}