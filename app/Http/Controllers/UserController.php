<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        return view('user.show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    public function update(RegisterRequest $request, User $user)
    {
        $this->userService->updateUser($user, $request->validated());
        return view('user.show', ['user' => $user])->with('success', 'Profile updated successfully');
    }

    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);

        return redirect(route('books.index'))->with('success', 'Profile deleted successfully');
    }
}
