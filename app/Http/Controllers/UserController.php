<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.users', ['users' => $users, 'roles' => $roles])->with('permissions');
    }

    public function destroy(User $user)
    {
        $user->delete();
        \Toastr::error('User has been deleted', null, ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }

    public function settings()
    {
        return view('users.settings');
    }
}