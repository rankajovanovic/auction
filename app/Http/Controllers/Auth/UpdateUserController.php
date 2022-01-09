<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use Illuminate\Http\Request;

class UpdateUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        $roles = Role::all();
        return view('users.profile')->with(['user' => $user, 'roles' => $roles]);
    }

    public function update(User $user)
    {
        $inputs = request()->validate([
            'username' => ['required', 'string', 'max:255', 'alpha_dash'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            // 'avatar' => ['file']
        ]);

        // if (request('avatar')) {
        //     $inputs['avatar'] = request('avatar')->store('images');
        // }

        $user->update($inputs);

        return back();
    }
}