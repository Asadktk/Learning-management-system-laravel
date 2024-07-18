<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function create()
    {
        $roles = Role::whereIn('role', ['instructor', 'student'])->get();

        return view('auth.register', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userAttributes = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(6)],
            'role_id' => ['required', 'exists:roles,id','in:2,3'],
        ]);

        $user = User::create($userAttributes);

        if ($user->role_id == 2) { 
            $user->instructor()->create();
        } elseif ($user->role_id == 3) { 
            $user->student()->create();
        }

        Auth::login($user);
        
        return redirect($user->role_id == 2 ? '/instructor/dashboard' : '/');

    }
}
