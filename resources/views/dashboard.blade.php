@extends('layouts.app')
@section('content')

<x-nav-bar :links="['Home' => 'home', 'My Books' => 'books', 'Notifications' => 'notifications']" />

<div class="container mx-auto p-4 mt-2">
    <div class="flex items-center justify-center mb-4">
        <div class="w-full max-w-md">
            <x-input name="search" id="search" placeholder="Search..." class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-700" />
        </div>
    </div>
    <div class="flex flex-wrap items-center justify-center space-y-4 md:space-y-0 md:space-x-4">
        <div class="w-full max-w-md md:w-auto">
            <x-select name="genre" :array="config('book.genres')" />
        </div>
        <div class="w-full max-w-md md:w-auto">
            <x-select name="language" :array="config('book.languages')" />
        </div>
        <div class="w-full max-w-md md:w-auto">
            <x-button>
                Submit
            </x-button>
        </div>
    </div>
</div>

<div class="container mx-auto p-4 space-y-6">
    @forelse ($books as $book)
        <div class="bg-white shadow-md rounded-lg p-4 w-full max-w-2xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-900 mb-2 tracking-wide">
                {{ $book->title }}
            </h2>

            <div class="flex justify-between items-center mb-4 mt-5">
                <div>
                    <p class="text-md text-gray-600 mb-4">
                        <strong class="text-gray-800">Author:</strong> {{ $book->author }}
                    </p>
                </div>

                <div class="flex space-x-2">
                    <button class="rounded-sm text-black hover:bg-black hover:text-white px-3 py-1 border border-black transition-colors duration-300 ease-in-out text-sm">
                        {{ Str::title(str_replace('_', ' ', $book->genre)) }}
                    </button>
                    
                    <button class="rounded-sm text-black hover:bg-black hover:text-white px-3 py-1 border border-black transition-colors duration-300 ease-in-out text-sm">
                        {{ Str::title( $book->language) }}
                    </button>                                 
                </div>
            </div>

            <div class="mt-4">
                <a href="/books/{{ $book->id }}" class="inline-block">
                    <x-button>
                        Show
                    </x-button>
                </a>
            </div>
        </div>
    @empty
        <div class="text-center text-black text-xl">
            No books available at the moment.
        </div>
    @endforelse

    @if ($books->count())
        <div class="flex justify-center mt-8">
            {{ $books->links('pagination::tailwind') }}
        </div>
    @endif
</div>