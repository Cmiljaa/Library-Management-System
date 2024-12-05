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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
