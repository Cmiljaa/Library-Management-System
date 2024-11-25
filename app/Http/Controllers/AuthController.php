<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

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
        $validatedData = $request->validated();

        return back()->with('success', 'LOGIN SUCCESS');
    }

    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        return back()->with('success', 'REGISTER SUCCESS');
    }

}
