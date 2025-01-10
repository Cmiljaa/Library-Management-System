@extends('layouts.app')
@section('content')

<div class="container mx-auto mt-8">
    <form action="{{ route('book_loans.index') }}" method="GET" class="flex flex-col items-center space-y-5">

        <div class="flex flex-col md:flex-row items-center justify-center space-y-5 md:space-x-5 md:space-y-0 w-full max-w-md">
            <div class="w-full md:w-1/2">
                <x-label for="borrow_date">Borrow Date</x-label>
                <x-input type="date" name="borrow_date" id="borrow_date"/>
            </div>
            <div class="w-full md:w-1/2">
                <x-label for="return_date">Return Date</x-label>
                <x-input type="date" name="return_date" id="return_date"/>
            </div>
        </div>

        <div class="w-full max-w-md">
            <x-label for="status" class="mb-2">Status</x-label>
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
    <div class="flex flex-col items-center space-y-5 mt-4">
        <div class="w-full max-w-md">
            <a href="{{ route('book_loans.create') }}">
                <x-button class="w-full">
                    Add Book Loan
                </x-button>
            </a>
        </div>
    </div>
    
</div>

<x-table :fields="['user', 'book', 'status', 'show']" :pagination="$book_loans" :action="route('book_loans.index')" :sortOptions="config('sort.book_loan')">
    @forelse ($book_loans as $book_loan)
        <tr class="bg-white hover:bg-gray-100">
            <td class="p-4 border border-gray-400 hover:underline"><a href="{{ route('users.book_loans', $book_loan->user_id) }}">{{ $book_loan->user->last_name }} {{ $book_loan->user->first_name }}</a></td>
            <td class="p-4 border border-gray-400 hover:underline"><a href="{{ route('books.show', $book_loan->book_id) }}">{{ $book_loan->book->title }}</a></td>
            <td class="p-4 border border-gray-400">
                <span class="{{ $book_loan->status === 'overdue' ? 'text-red-600' : ($book_loan->status === 'borrowed' ? 'text-blue-600' : '') }}">
                    {{ Str::ucfirst($book_loan->status) }}
                </span>
            </td>
            <td class="p-4 border border-gray-400 text-center">
                <a href="{{ route('book_loans.show', $book_loan) }}">
                    <x-button>
                        Show
                    </x-button>
                </a>
            </td>
        </tr>
    @empty
    <tr>
        <td colspan="6" class="text-center p-4 text-black">
            No book loans available at the moment.
        </td>
    </tr>
    @endforelse
</x-table>

@endsection
