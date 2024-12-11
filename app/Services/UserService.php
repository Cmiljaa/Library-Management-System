<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class UserService
{

    public function createUserFromGoogleData($googleUser): void
    {
        $this->registerUser([
            'first_name' => $googleUser->name,
            'last_name'  => '',
            'email'      => $googleUser->email,
            'google_id'  => $googleUser->id,
            'role'       => 'member'
        ], true);
    }

    public function handleGoogleCallback(): bool
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $findUser = User::where('google_id', $googleUser->id)->first();

            if ($findUser) {
                Auth::login($findUser);
                return true;
            }
            else
            {
                $this->createUserFromGoogleData($googleUser);
                return false;
            }
        }
        catch (Exception $e)
        {
            abort(500, 'An error occurred during Google authorization. Please try again later.');
        }
    }

    public function registerUser(array $credentials, bool $useFactory = false): void
    {
        try {
            $user = $useFactory ? User::factory()->create($credentials) : User::create($credentials);

            Auth::login($user);

            session()->regenerate();
        }
        catch (Exception $e)
        {
            abort(500, 'We encountered an issue while creating your account. Please try again later.');
        }
    }

    public function updateUser(User $user, array $data): void
    {
        $user->update($data);
    }

    public function deleteUser(User $user): void
    {
        request()->session()->invalidate();

        $user->delete();
    }
}