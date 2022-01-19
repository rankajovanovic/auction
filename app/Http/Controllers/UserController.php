<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Actions\UserActions\GetUserProfileDataAction;
use App\Models\Item;

class UserController extends Controller
{

    protected GetUserProfileDataAction $getUserProfileDataAction;

    public function __construct(GetUserProfileDataAction $getUserProfileDataAction)
    {
        $this->getUserProfileDataAction = $getUserProfileDataAction;
    }

    public function index()
    {
        return view('admin.users', ['users' => User::all(), 'roles' => Role::all()])->with('permissions');
    }

    public function destroy(User $user)
    {
        foreach (Item::where('user_id', '=', $user->id) as $item) {
            $item->delete();
        }
        $user->delete();

        \Toastr::error('User has been deleted', null, ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }

    public function profile(User $user)
    {
        $data = $this->getUserProfileDataAction->execute($user);

        return view('users.profile', ['data' => $data, 'user' => $user]);
    }
}