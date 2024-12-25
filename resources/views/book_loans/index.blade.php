@extends('layouts.app')
@section('content')

<div class="container mx-auto mt-8">
    <form action="{{ route('book_loans.index') }}" method="GET" class="flex flex-col items-center space-y-5">

        <div class="flex flex-col md:flex-row items-center justify-center space-y-5 md:space-x-5 md:space-y-0 w-full max-w-md">
            <div class="w-full md:w-1/2">
                <x-label for="borrow_date">Borrow Date</x-label>
                <x-input type="date" name="borrow_date" id="borrow_date" placeholder="Borrow Date"/>
            </div>
            <div class="w-full md:w-1/2">
                <x-label for="return_date">Return Date</x-label>
                <x-input type="date" name="return_date" id="return_date" placeholder="Return Date"/>
            </div>
        </div>

        <div class="w-full max-w-md">
            <x-label for="status">Status</x-label>
            <x-select name="status" id="status" :array="config('book.statuses')" />
        </div>

        <div class="flex items-center justify-center space-x-5 w-full max-w-md">
            <div class="w-full">
                <x-input name="search" id="search" placeholder="Search..." class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-700" />
            </div>
            <div>
                <x-button>
                    Submit
                </x-button>
            </div>
        </div>
    </form>
</div>

<div class="container mx-auto max-w-7xl py-10 mb-36">
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-8">
        <table class="w-full border-collapse border border-gray-400">
            <thead>
                <tr class="bg-black text-white">
                    <th class="p-4 border border-gray-400">User</th>
                    <th class="p-4 border border-gray-400">Book</th>
                    <th class="p-4 border border-gray-400">Pickup Date</th>
                    <th class="p-4 border border-gray-400">Return Date</th>
                    <th class="p-4 border border-gray-400">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($book_loans as $book_loan)
                    <tr class="bg-white hover:bg-gray-100">
                        <td class="p-4 border border-gray-400"><a href="{{ route('users.show', $book_loan->user_id) }}">{{ $book_loan->user->last_name }} {{ $book_loan->user->first_name }}</a></td>
                        <td class="p-4 border border-gray-400"><a href="{{ route('books.show', $book_loan->book_id) }}">{{ $book_loan->book->title }}</a></td>
                        <td class="p-4 border border-gray-400">{{ Carbon\Carbon::parse($book_loan->borrow_date)->format('jS F, Y') ?? '' }}</td>
                        <td class="p-4 border border-gray-400">{{ $book_loan->return_date ? Carbon\Carbon::parse($book_loan->return_date)->format('jS F, Y') : ''}}</td>
                        <td class="p-4 border border-gray-400">{{ Str::ucfirst($book_loan->status) }}</td>
                    </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center p-4 text-black">
                        No book loans available at the moment.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($book_loans->count())
        <div class="flex justify-center mt-8">
            {{ $book_loans->links('pagination::tailwind') }}
        </div>
    @endif
</div>
@endsection
