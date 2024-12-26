@extends('layouts.app')
@section('content')
<div class="container mx-auto p-4 mt-10 bg-white rounded-lg shadow-lg">
    <form action="{{ route('book_loans.create') }}" method="GET" class="w-full p-2">
        <div class="flex flex-col sm:flex-row justify-between mt-4 space-y-6 sm:space-y-0 sm:gap-6">
            <div class="flex flex-col items-start space-y-4 w-full sm:w-1/2">
                <div class="w-full">
                    <x-label for="first_name">First Name</x-label>
                    <x-input name="first_name" id="first_name" placeholder="John" />
                </div>
                <div class="w-full">
                    <x-label for="last_name">Last Name</x-label>
                    <x-input name="last_name" id="last_name" placeholder="Doe" />
                </div>
                <div class="w-full">
                    <x-label for="email">Email</x-label>
                    <x-input name="email" id="email" placeholder="johndoe@mail.com" />
                </div>
            </div>

            <div class="flex flex-col items-start space-y-4 w-full sm:w-1/2">
                <div class="w-full">
                    <x-label for="search">Book</x-label>
                    <x-input name="search" id="search" placeholder="Search..."/>
                </div>
                <div class="w-full">
                    <x-label for="genre" class="mb-3">Genre</x-label>
                    <x-select name="genre" id="genre" :array="config('book.genres')" />
                </div>
                <div class="w-full">
                    <x-label for="language" class="mb-3">Language</x-label>
                    <x-select name="language" id="language" :array="config('book.languages')" />
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-6">
            <x-button class="w-full">Submit</x-button>
        </div>
    </form>
</div>
<div class="flex justify-center items-center py-5 my-5">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-700">Book Loan</h2>
        <form action="{{ route('book_loans.store') }}" method="POST" class="flex flex-col items-center space-y-5 mt-5">
            @csrf
            <div class="w-full max-w-md">
                <x-label for="user_id" class="mb-2.5">User</x-label>
                <select name="user_id" id="user_id" class="text-left w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none sm:text-sm">
                    <option value="">User</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-red-600 text-sm">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="w-full max-w-md">
                <x-label for="book_id" class="mb-2.5">Book</x-label>
                <select name="book_id" id="book_id" class="text-left w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none sm:text-sm">
                    <option value="">Book</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}">{{ Str::ucfirst($book->title) }}</option>
                    @endforeach
                </select>
                @error('book_id')
                    <p class="text-red-600 text-sm">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="w-full max-w-md">
                <x-label for="status" class="mb-2">Status</x-label>
                <x-select name="status" id="status" :array="config('book.statuses')" />
            </div>
    
            <div class="w-full">
                <x-button class="w-full">
                    Submit
                </x-button>
            </div>
        </form>
    </div>
</div>
@endsection