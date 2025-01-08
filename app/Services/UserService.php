<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class UserService
{
    public function createUserFromGoogleData($googleUser): void
    {
        $nameParts = explode(' ', $googleUser->name);

        $firstName = $nameParts[0];

        $lastName = count($nameParts) > 1 ? $nameParts[1] : '';
        $this->registerUser([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $googleUser->email,
            'google_id' => $googleUser->id,
            'role'=> 'member'
        ], true);
    }

    public function handleGoogleCallback(): bool
    {
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

    public function registerUser(array $credentials, bool $useFactory = false): void
    {
        $user = $useFactory ? User::factory()->create($credentials) : User::create($credentials);

        Auth::login($user);

        session()->regenerate();
    }

    public function loginUser(array $credentials): bool
    {
        if(Auth::attempt($credentials))
        {
            session()->regenerate();

            return true;
        }

        return false;
    }

    public function logoutUser(): void
    {
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();
    }

    public function googleUser(User $user): void
    {
        if($user->google_id === null)
        {
            return;
        }

        abort(500, "You can't edit google profile.");
    }

    public function updateUser(User $user, array $data): void
    {
        $this->googleUser($user);
        $user->update($data);
    }

    public function deleteUser(User $user): void
    {
        request()->session()->invalidate();

        $user->delete();
    }

    public function getUsersByRoles(Request $request, array $roles = ['admin', 'librarian', 'member'])
    {
        return User::whereIn('role', $roles)
        ->FilterByAttribute($request, ['first_name', 'last_name', 'email'])
        ->ApplySorting($request->sort, config('sort.user'))
        ->paginate(15)
        ->appends($request->only(['sort', 'first_name', 'last_name', 'email']));
    }
}