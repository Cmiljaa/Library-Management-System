@extends('layouts.app')
@section('content')
<div class="container mx-auto p-6 my-16 bg-white text-gray-900 rounded-lg shadow-xl transition-shadow hover:shadow-2xl">
    <div class="border-b border-gray-300 pb-6 mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">{{ $book->title }}</h1>
        </div>
        <p class="text-base text-gray-500 mt-2 italic">{{ $book->author }}</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Description</h2>
            <p class="text-gray-700 leading-relaxed">{{ $book->description }}</p>
        </div>

        <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Book Details</h2>
            <ul class="text-gray-700 space-y-4">
                <li>
                    <span class="font-bold text-gray-900">Genre:</span> 
                    {{ Str::ucfirst(Str::replace('_', ' ', $book->genre)) }}
                </li>
                <li>
                    <span class="font-bold text-gray-900">Language:</span> 
                    {{ Str::ucfirst($book->language) }}
                </li>
                <li>
                    <span class="font-bold text-gray-900">Availability:</span> 
                    <span class="{{ $book->available ? 'text-green-600' : 'text-red-600' }} font-semibold">
                        {{ $book->available ? 'Available' : 'Unavailable' }}
                    </span>
                </li>
            </ul>
        </div>
    </div>

    <div class="mt-10 flex flex-col sm:flex-row sm:justify-between items-center">
        <a href="{{ route('books.index') }}">
            <x-button>
                Back to Book List
            </x-button>
        </a>
        @if(!$reviews->isEmpty())
            <div class="flex items-center gap-2 mt-4 sm:mt-0">
                <span class="flex text-2xl">
                    <x-star :number="$reviews->avg('rating')" />
                </span>
                <span class="text-black font-semibold text-base">{{ number_format($reviews->avg('rating'), 1) }} / 5</span>
            </div>
        @endif
    </div>
    
</div>



<div class="container mx-auto mb-16 text-gray-900 rounded-lg text-center sm:text-left">
    @forelse ($reviews as $review)
        <div class="review-container bg-white p-4 rounded-lg shadow-md mb-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-2 mb-3 sm:mb-3">
                <div class="mr-2 text-center sm:text-left">
                    <span class="font-semibold">{{ $review->user->first_name }} {{ $review->user->last_name }}</span>
                </div>
                <span class="flex text-xl justify-center sm:justify-start">
                    <x-star :number="$review->rating" />
                </span>
            </div>
            
            <div class="review-description text-gray-700">
                <p>
                    {{ $review->description }}
                </p>
            </div>
            <div class="text-sm text-gray-500 mt-2">
                <span>{{ $review->created_at->diffForHumans() }}</span>
            </div>
        </div>
    @empty
        <div class="text-center text-black text-xl">
            There are no reviews available for this book yet.
        </div>
    @endforelse
</div>

@endsection