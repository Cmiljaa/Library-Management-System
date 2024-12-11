<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class UserService
{

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