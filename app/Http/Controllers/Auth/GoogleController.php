<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(): RedirectResponse
    {
        try
        {
            if($this->userService->handleGoogleCallback())
            {
                return redirect(route('books.index'))->with('success', 'You have successfully logged in');
            }
            else
            {
                return redirect(route('books.index'))->with('success', 'Account created successfully');
            }
        }
        catch (Exception $e)
        {
            return redirect()->route('auth.login')->with('error', 'An error occurred during Google authentication. Please try again later.');
        }
    }
}
