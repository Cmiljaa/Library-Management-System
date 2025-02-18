<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\BookLoanService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(protected readonly UserService $userService) {}

    public function index(Request $request): View
    {
        return view('users.index', [
            'users' => $this->userService->getUsersByRoles($request,Auth::user()->role === 'admin' ? ['member', 'librarian'] : ['member'])
        ]);
    }

    public function show(User $user): View
    {
        return view('users.show', ['user' => $user]);
    }

    public function edit(User $user): View
    {
        $this->userService->googleUser($user);
        return view('users.edit', ['user' => $user]);
    }

    public function update(RegisterRequest $request, User $user): RedirectResponse
    {
        $this->userService->updateUser($user, $request->validated());
        return redirect(route('users.show', ['user' => $user]))->with('success', 'Profile updated successfully');
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->userService->deleteUser($user);

        return redirect(route('books.index'))->with('success', 'Profile deleted successfully');
    }

    public function userBookLoans(User $user, BookLoanService $bookLoanService): View
    {
        return view('users.book_loans', ['bookLoans' => $bookLoanService->getUserBooks($user), 'user' => $user]);
    }
}
