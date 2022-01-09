<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\User;
use App\Models\Role;

class AdminController extends Controller
{
    //

    public function index()
    {
        return view('admin.index');
    }

    public function getItems()
    {
        $items = Item::all();

        return view('admin.items')->with(['items' => $items]);
    }

    public function attach(User $user)
    {
        session()->flash('success', 'Role attached');
        $user->roles()->attach(request('role'));

        return back();
    }

    public function detach(User $user)
    {
        session()->flash('danger', 'Role detached');
        $user->roles()->detach(request('role'));

        return back();
    }
}