@extends('layouts.app')
@section('content')
<div class="container mx-auto p-4 mt-2">
    <form action="{{ route('users.index') }}" method="GET">
        <div class="flex flex-wrap items-center justify-center space-y-4 md:space-y-0 md:space-x-4">
            <div class="w-full max-w-md md:w-auto">
                <x-label for="first_name">First Name</x-label>
                <x-input name="first_name" id="first_name" placeholder="John" />
            </div>
            <div class="w-full max-w-md md:w-auto">
                <x-label for="last_name">Last Name</x-label>
                <x-input name="last_name" id="last_name" placeholder="Doe" />
            </div>
            <div class="w-full max-w-md md:w-auto">
                <x-label for="email">Email</x-label>
                <x-input name="email" id="email" placeholder="johndoe@mail.com" />
            </div>
        </div>
        <div class="flex justify-center md:justify-center mt-3">
            <x-button>
                Submit
            </x-button>
        </div>
    </form>
</div>

<x-table  :fields="Auth::user()->role === 'admin' ? ['name', 'email', 'phone', 'role', 'edit', 'delete'] : ['name', 'email', 'phone', 'edit', 'delete']"
 :pagination="$users" :action="route('users.index')" :sortOptions="config('sort.user')">
    @forelse ($users as $user)
        <tr class="bg-white hover:bg-gray-100">
            <td class="p-4 border border-gray-400 hover:underline"><a href="{{ route('users.show', $user) }}">{{ $user->first_name }} {{ $user->last_name }}</a></td>
            <td class="p-4 border border-gray-400">{{ $user->email }}</td>
            <td class="p-4 border border-gray-400">{{ $user->phone }}</td>
            <x-role-access :roles="['admin']">
                <td class="p-4 border border-gray-400">{{ Str::ucfirst($user->role) }}</td>
            </x-role-access>
            <td class="p-4 border border-gray-400 text-center">
                @if ($user->google_id === null)
                    <a href="{{ route('users.edit', $user) }}">
                        <x-button>
                            Edit
                        </x-button>
                    </a>
                @endif
            </td>
            <td class="p-4 border border-gray-400 text-center">
                <x-delete :action="route('users.destroy', $user)" name="profile" />
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center p-4 text-black">
                No users available at the moment.
            </td>
        </tr>
    @endforelse
</x-table>
@endsection
