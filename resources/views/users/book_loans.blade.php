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

<x-table :fields="['book', 'borrow date', 'return date', 'status', 'show']" :pagination="$bookLoans" :action="route('book_loans.index')" :sortOptions="config('sort.book_loan')">
    @forelse ($bookLoans as $bookLoan)
        <tr class="bg-white hover:bg-gray-100">
            <td class="p-4 border border-gray-400 hover:underline"> <a href="{{ route('books.show', $bookLoan->book_id) }}" class=""> {{ $bookLoan->book->title }}</a></td>
            <td class="p-4 border border-gray-400">{{ Carbon\Carbon::parse($bookLoan->borrow_date)->format('jS F, Y') ?? '' }}</td>
            <td class="p-4 border border-gray-400">
                {{ $bookLoan->return_date ? Carbon\Carbon::parse($bookLoan->return_date)->format('jS F, Y') : ''}}
            </td>
            <td class="p-4 border border-gray-400">
                <span class="{{ $bookLoan->status === 'overdue' ? 'text-red-600' : ($bookLoan->status === 'borrowed' ? 'text-blue-600' : '') }}">
                    {{ Str::ucfirst($bookLoan->status) }}
                </span>
            </td>
            <td class="p-4 border border-gray-400 text-center">
                <a href="{{ route('book_loans.show', $bookLoan) }}">
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
