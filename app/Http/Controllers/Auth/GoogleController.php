<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $findUser = User::where('google_id', $user->id)->first();

            if ($findUser) {
                Auth::login($findUser);
                return redirect(route('books.index'))->with('success', 'You have successfully logged in');
            } else {
                $newUser = User::factory()->create([
                    'first_name' => $user->name,
                    'last_name' => '',
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'role' => 'member'
                ]);

                Auth::login($newUser);
                return redirect(route('books.index'))->with('success', 'Account created successfully');
            }
        } catch (Exception $e) {
            return redirect(route('login'))->with('error', 'An error occurred');
        }
    }
}
