<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\OtpVerificationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
            'role_id' => ['required', 'exists:roles,id', 'in:2,3'],
        ]);

        $otp = rand(100000, 999999);

        // Add OTP to user attributes
        $userAttributes['otp'] = $otp;

        $user = User::create($userAttributes);

        if ($user->role_id == 2) {
            $user->instructor()->create();
        } elseif ($user->role_id == 3) {
            $user->student()->create();
        }

        Mail::to($user->email)->send(new OtpVerificationMail($otp));
        
        Auth::login($user);

        return redirect()->route('otp.verify.show');
        // return redirect($user->role_id == 2 ? '/instructor/dashboard' : '/');
    }
}
