@extends('layouts.app')
@section('content')
<div class="container mx-auto max-w-7xl py-12 mb-36">
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-8">
        <table class="w-full border-collapse border border-gray-400">
            <thead>
                <tr class="bg-black text-white">
                    <th class="p-4 border border-gray-400">First Name</th>
                    <th class="p-4 border border-gray-400">Last Name</th>
                    <th class="p-4 border border-gray-400">Email</th>
                    <th class="p-4 border border-gray-400">Phone</th>
                    <th class="p-4 border border-gray-400">Edit</th>
                    <th class="p-4 border border-gray-400">Delete</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($members as $member)
                    <tr class="bg-white hover:bg-gray-100">
                        <td class="p-4 border border-gray-400">{{ $member->first_name }}</td>
                        <td class="p-4 border border-gray-400">{{ $member->last_name }}</td>
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
            </tbody>
        </table>
    </div>
</div>
@endsection
