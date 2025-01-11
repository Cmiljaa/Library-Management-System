<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function loginForm(): View
    {
        return view('auth.login');
    }

    public function registerForm(): View
    {
        return view('auth.register');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        if($this->userService->loginUser($request->validated()))
        {
            return redirect(route('books.index'))->with('success', 'You have successfully logged in');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function register(RegisterRequest $request): RedirectResponse
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

    public function logout(): RedirectResponse
    {
        $this->userService->logoutUser();
        return redirect(route('auth.login'))->with('success', 'Logged out successfully');
    }

}
