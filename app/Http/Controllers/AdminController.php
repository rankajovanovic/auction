<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        return view('admin.items')->with(['items' => $items]);
    }

    public function attach(User $user)
    {
        \Toastr::success('Role attached', null, ["positionClass" => "toast-top-right"]);
        $user->roles()->attach(request('role'));

        return back();
    }

    public function detach(User $user)
    {
        \Toastr::success('Role detached', null, ["positionClass" => "toast-top-right"]);
        $user->roles()->detach(request('role'));

        return back();
    }
}