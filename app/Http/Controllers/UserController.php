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

    public function index(Request $request)
    {
        return view('user.index', ['members' => $this->userService->getUsersByRoles($request, ['member'])]);
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
        $this->userService->googleUser($user);
        return view('user.edit', ['user' => $user]);
    }

    public function update(RegisterRequest $request, User $user)
    {
        $this->userService->updateUser($user, $request->validated());
        return redirect(route('users.show', ['user' => $user]))->with('success', 'Profile updated successfully');
    }

    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);

        return redirect(route('books.index'))->with('success', 'Profile deleted successfully');
    }

    public function userBookLoans(User $user)
    {
        $bookLoans = $this->userService->getUserBooks($user);
        return view('user.book_loans', ['book_loans' => $bookLoans]);
    }
}
