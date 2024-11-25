<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
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
        $validatedData = $request->validated();

        return back()->with('success', 'REGISTER SUCCESS');
    }

}
