<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials do not match.',
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        switch ($user->role->role) {
            case 'admin':
                return redirect('/admin/dashboard');
            case 'instructor':
                return redirect('/instructor/dashboard');
            default:
                return redirect('/');
        }
    }

    public function edit()
    {
        return view('auth.edit-profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        switch ($user->role->role) {
            case 'admin':
                return redirect('/admin/dashboard');
            case 'instructor':
                return redirect('/instructor/dashboard');
            default:
                return redirect('/');
        }

        // return redirect()->back()->with('success', 'Profile name updated successfully.');
    }


    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
