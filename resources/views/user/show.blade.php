@extends('layouts.app')
@section('content')
<div class="flex justify-center items-center">
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
    <div class="container mx-auto p-2 mt-2 max-w-4xl">
        <h1 class="text-2xl font-bold">
            <a href="{{ route('users.book_loans', $user) }}" 
                class="hover:underline">
                Book Loans of {{ $user->first_name }} {{ $user->last_name }}
            </a>
        </h1>
        @forelse ($user->notifications as $notification)
            <div class="px-4 py-4 bg-red-50 rounded-md my-3 transition-all duration-300 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h1m0 8h.01M12 9v3m-6.93 4.36a9 9 0 1111.32 0M15 3h-6a2 2 0 00-2 2v2a2 2 0 002 2h6a2 2 0 002-2V5a2 2 0 00-2-2z" />
                    </svg>
                    <div>
                        <strong class="text-lg text-red-600">{{ $notification->data['fee'] }} $</strong>
                        <p class="text-sm text-black"><strong>Book Title:</strong> {{ $notification->data['book_title'] }}</p>
                    </div>
                </div>

                <x-delete :action="route('notifications.destroy', $notification)" name="overdue fee" />
            </div>
        @empty
            <p class="px-4 py-4 text-black">No notifications available.</p>
        @endforelse
    </div>
</x-role-access>

@endsection