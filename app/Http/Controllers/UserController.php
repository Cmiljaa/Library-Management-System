<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
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
        Gate::authorize('allowed', $user);

        return view('user.show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        if(Gate::allows('allowed', $user) && $user->google_id === null)
        {
            return view('user.edit', ['user' => $user]);
        }
        else
        {
            return redirect(route('user.show', ['user' => $user]));
        }
    }

    public function update(RegisterRequest $request, User $user)
    {
        if(Gate::allows('allowed', $user) && $user->google_id === null)
        {
            $user->update($request->validated());
            return view('user.show', ['user' => $user])->with('success', 'Profile updated successfully');
        }
        else
        {
            return redirect(route('user.show', ['user' => $user]));
        }
    }

    public function destroy(User $user)
    {
        Gate::authorize('allowed', $user);

        request()->session()->invalidate();

        $user->delete();

        return redirect(route('books.index'))->with('success', 'Profile deleted successfully');
    }
}
