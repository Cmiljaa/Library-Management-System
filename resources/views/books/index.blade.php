@extends('layouts.app')
@section('content')

<div class="container mx-auto p-4 mt-2">
    @auth
        @if (Auth::user()->role != 'member')
            <div class="flex justify-center mb-4">
                <a href="{{ route('books.create') }}">
                    <x-button>
                        Add Book
                    </x-button>
                </a>
            </div>
        @endif
    @endauth
    <form action="{{ route('books.index') }}" method="GET">
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
    </form>
</div>

<div class="container mx-auto p-4 space-y-6">
    @forelse ($books as $book)
        <div class="bg-white shadow-md rounded-lg p-4 w-full max-w-2xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-900 mb-2 tracking-wide text-center sm:text-left">
                {{ $book->title }}
            </h2>

            <div class="flex flex-col sm:flex-row justify-between items-center mb-4 mt-5 sm:space-x-4">
                <div class="w-full sm:w-1/2 mb-4 sm:mb-0">
                    <p class="text-md text-gray-600">
                        <strong class="text-gray-800">Author:</strong> {{ $book->author }}
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 w-full sm:w-auto">
                    <button class="rounded-sm text-black hover:bg-black hover:text-white px-3 py-1 border border-black transition-colors duration-300 ease-in-out text-sm w-full sm:w-auto">
                        <a href="?genre={{ $book->genre }}">
                            {{ Str::title(str_replace('_', ' ', $book->genre)) }}
                        </a>
                    </button>
                    
                    <button class="rounded-sm text-black hover:bg-black hover:text-white px-3 py-1 border border-black transition-colors duration-300 ease-in-out text-sm w-full sm:w-auto">
                        <a href="?language={{ $book->language }}">
                            {{ Str::title( $book->language) }}
                        </a>
                    </button>                                 
                </div>
            </div>

            <div class="mt-4 flex justify-between items-center sm:flex-row flex-col text-center sm:text-left">
                <div>
                    <a href="/books/{{ $book->id }}" class="inline-block">
                        <x-button>
                            Show
                        </x-button>
                    </a>
                </div>
            
                @if ($book->reviews_avg_rating != 0)
                    <div class="flex items-center gap-2 mt-4 sm:mt-0">
                        <span class="flex text-2xl">
                            <x-star :number="$book->reviews_avg_rating" />
                        </span>
                        <span class="text-black font-semibold text-base">
                            {{ number_format($book->reviews_avg_rating, 1) }} / 5
                        </span>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="text-center text-black text-xl mb-48">
            No books available at the moment.
        </div>
    @endforelse

    @if ($books->count())
        <div class="flex justify-center mt-8">
            {{ $books->links('pagination::tailwind') }}
        </div>
    @endif
</div>

@endsection