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

<x-table :fields="['name', 'email', 'phone', 'edit', 'delete']" :pagination="$members" :action="route('users.index')" :sortOptions="config('sort.user')">
    @forelse ($members as $member)
        <tr class="bg-white hover:bg-gray-100">
            <td class="p-4 border border-gray-400"><a href="{{ route('users.show', $member) }}">{{ $member->first_name }} {{ $member->last_name }}</a></td>
            <td class="p-4 border border-gray-400">{{ $member->email }}</td>
            <td class="p-4 border border-gray-400">{{ $member->phone }}</td>
            <td class="p-4 border border-gray-400 text-center">
                @if ($member->google_id === null)
                    <a href="{{ route('users.edit', $member) }}">
                        <x-button>
                            Edit
                        </x-button>
                    </a>
                @endif
            </td>
            <td class="p-4 border border-gray-400 text-center">
                <form method="POST" action="{{ route('users.destroy', $member) }}" class="inline-block">
                    @method('DELETE')
                    @csrf
                    <x-button class="text-white  rounded-lg !bg-red-600 hover:!bg-transparent hover:!text-red-600 hover:!border-red-600 focus:outline-none focus:ring-2 focus:!ring-red-600">
                        Delete
                    </x-button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center p-4 text-black">
                No members available at the moment.
            </td>
        </tr>
    @endforelse
</x-table>
@endsection
