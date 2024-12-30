@extends('layouts.app')
@section('content')
<div class="flex justify-center items-center mb-20">
    <div class="container mx-auto p-6 mt-10 bg-white text-gray-900 rounded-lg shadow-lg max-w-4xl">
        <div class="border-b border-gray-300 pb-4 mb-6">
            <h1 class="text-4xl font-extrabold text-gray-900">
                {{ $user->first_name }} {{ $user->last_name }}
            </h1>
            <p class="text-sm text-gray-500 mt-1">{{ Str::ucfirst($user->role) }}</p>
        </div>

        <div class="grid grid-cols-1 gap-6">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-3">User Information</h2>
                <ul class="text-gray-700 space-y-2">
                    @if ($user->last_name != '')
                        <li><strong>First Name:</strong> {{ $user->first_name }}</li>
                        <li><strong>Last Name:</strong> {{ $user->last_name }}</li>
                    @else
                        <li><strong>Name:</strong> {{ $user->first_name }}</li>
                    @endif
                    <li><strong>Email:</strong> {{ $user->email }}</li>
                    <li><strong>Phone:</strong> {{ $user->phone }}</li>
                    <li><strong>Date Joined:</strong> {{ Carbon\Carbon::parse($user->created_at)->format('jS F, Y') }}</li>
                </ul>
            </div>
        </div>
        <div class="flex space-x-4 mt-6">
            @if ($user->google_id === null)
                <a href="{{ route('users.edit', $user) }}">
                    <x-button>
                        Update Profile
                    </x-button>
                </a>
            @endif

            <x-delete :action="route('users.destroy', $user)" name="profile" />
        </div>
    </div>
</div>

<x-role-access :roles="['librarian', 'admin']">
    <div class="flex items-center justify-center mt-10">
        <div class="bg-white text-black rounded-lg shadow-lg p-8 text-center">
            <h1 class="text-3xl font-bold">
                <a href="{{ route('users.book_loans', $user) }}" 
                    class="text-black  hover:underline">
                    Book Loans of {{ $user->first_name }} {{ $user->last_name }}
                </a>
            </h1>
        </div>
    </div>
</x-role-access>

@endsection