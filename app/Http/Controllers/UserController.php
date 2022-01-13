<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Actions\UserActions\GetUserProfileDataAction;

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
        $user->delete();
        \Toastr::error('User has been deleted', null, ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }

    public function profile()
    {
        $data = $this->getUserProfileDataAction->execute();

        return view('users.profile', compact('data'));
    }
}