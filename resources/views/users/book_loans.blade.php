@extends('layouts.app')
@section('content')

<x-role-access :roles="['librarian', 'admin']">
    <div class="flex items-center justify-center mt-10">
        <div class="bg-white text-black rounded-lg shadow-lg p-8 text-center">
            <h1 class="text-3xl font-bold">
                <a href="{{ route('users.show', $user) }}"
                    class="text-black  hover:underline">
                    Book Loans of {{ $user->first_name }} {{ $user->last_name }}
                </a>
            </h1>
        </div>
    </div>
</x-role-access>

<x-table :fields="['book', 'borrow date', 'return date', 'status', 'show']" :pagination="$book_loans" :action="route('book_loans.index')" :sortOptions="config('sort.book_loan')">
    @forelse ($book_loans as $book_loan)
        <tr class="bg-white hover:bg-gray-100">
            <td class="p-4 border border-gray-400 hover:underline"> <a href="{{ route('books.show', $book_loan->book_id) }}" class=""> {{ $book_loan->book->title }}</a></td>
            <td class="p-4 border border-gray-400">{{ Carbon\Carbon::parse($book_loan->borrow_date)->format('jS F, Y') ?? '' }}</td>
            <td class="p-4 border border-gray-400">
                {{ $book_loan->return_date ? Carbon\Carbon::parse($book_loan->return_date)->format('jS F, Y') : ''}}
            </td>
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
