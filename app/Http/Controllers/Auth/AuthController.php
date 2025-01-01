<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

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
        if($this->userService->loginUser($request->validated()))
        {
            return redirect(route('books.index'))->with('success', 'You have successfully logged in');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function register(RegisterRequest $request)
    {
        try
        {
            $this->userService->registerUser($request->validated());

            return redirect(route('books.index'))->with('success', 'Account created successfully');
        }
        catch(\Exception $e)
        {
            
            return redirect(route('books.index'))->with('error', 'An error occurred while creating your account.');
        }
    }

    public function logout()
    {
        $this->userService->logoutUser();
        return redirect(route('auth.login'))->with('success', 'Logged out successfully');
    }

}
