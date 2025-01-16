<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(UserService $userService): RedirectResponse
    {
        try
        {
            $message = $userService->handleGoogleCallback() ? 'You have successfully logged in' : 'Account created successfully';
            return redirect(route('books.index'))->with('success', $message);
        }
        catch (Exception $e)
        {
            return redirect()->route('auth.login')->with('error', 'An error occurred during Google authentication. Please try again later.');
        }
    }
}
