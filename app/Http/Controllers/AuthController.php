<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function login(LoginRequest $request)
    {
        if(Auth::attempt($request->validated()))
        {
            $request->session()->regenerate();

            return redirect(route('dashboard'))->with('success', 'You have successfully logged in');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function register(RegisterRequest $request)
    {
        User::create($request->validated());

        $request->session()->regenerate();

        return redirect(route('dashboard'))->with('success', 'Account created successfully');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('auth.login'))->with('success', 'Logged out successfully');
    }

}
