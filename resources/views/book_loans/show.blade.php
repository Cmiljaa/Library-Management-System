@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 mt-10 bg-white text-gray-900 rounded-lg shadow-lg transition-shadow hover:shadow-xl">
    <div class="border-b border-gray-300 pb-6 mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">
                Loan Details
            </h1>
        </div>
        <p class="text-base text-gray-500 mt-2 italic">
            <a href="{{ route('users.show', $book_loan->user) }}">Borrowed by: {{ $book_loan->user->first_name }} {{ $book_loan->user->last_name }}</a>
        </p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Book Information</h2>
            <ul class="text-gray-700 space-y-4">
                <li>
                    <span class="font-bold text-gray-900">Title:</span> 
                    {{ $book_loan->book->title }}
                </li>
                <li>
                    <span class="font-bold text-gray-900">Author:</span> 
                    {{ $book_loan->book->author }}
                </li>
                <li>
                    <span class="font-bold text-gray-900">Genre:</span> 
                    {{ Str::ucfirst($book_loan->book->genre) }}
                </li>
            </ul>
        </div>

        <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Loan Details</h2>
            <ul class="text-gray-700 space-y-4">
                <li>
                    <span class="font-bold text-gray-900">Borrow Date:</span> 
                    {{ Carbon\Carbon::parse($book_loan->borrow_date)->format('jS F, Y') ?? '' }}
                </li>
                <li>
                    <span class="font-bold text-gray-900">Return Date:</span> 
                    {{ $book_loan->return_date ? Carbon\Carbon::parse($book_loan->return_date)->format('jS F, Y') : 'Not returned yet'}}
                </li>
                <li>
                    <span class="font-bold text-gray-900">Status:</span> 
                    <span class="{{ $book_loan->status === 'overdue' ? 'text-red-600' : ($book_loan->status === 'borrowed' ? 'text-blue-600' : '') }}">
                        {{ Str::ucfirst($book_loan->status) }}
                    </span>
                </li>
            </ul>
        </div>
    </div>

    <div class="mt-10 flex flex-col sm:flex-row sm:justify-between space-y-4 sm:space-y-0 items-center">
        <a href="{{ route('book_loans.index') }}">
            <x-button>
                Back to Loan List
            </x-button>
        </a>

        <x-role-access :roles="['librarian', 'admin']">
            <a href="{{ route('book_loans.edit', $book_loan) }}">
                <x-button>
                    Edit Loan
                </x-button>
            </a>
            
        </x-role-access>
    </div>
</div>

@if ($notification)
    <div class="container mx-auto p-2 mt-2 max-w-8xl">
        <x-notification :notification="$notification" />
    </div>
@endif

@endsection
