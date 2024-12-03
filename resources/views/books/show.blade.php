@extends('layouts.app')
@section('content')
<div class="container mx-auto p-6 my-16 bg-white text-gray-900 rounded-lg text-center shadow-lg sm:text-left">
    <div class="border-b border-gray-300 pb-4 mb-6">
        <h1 class="text-4xl font-extrabold text-gray-900">{{ $book->title }}</h1>
        <p class="text-base text-gray-500 mt-1">By {{ $book->author }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-3">Description</h2>
            <p class="text-gray-700">{{ $book->description }}</p>
        </div>

        <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-3">Book Details</h2>
            <ul class="text-gray-700 space-y-2">
                <li><span class="font-bold text-gray-900">Genre:</span> {{ Str::ucfirst(Str::replace('_', ' ', $book->genre))  }}</li>
                <li><span class="font-bold text-gray-900">Language:</span> {{ Str::ucfirst($book->language) }}</li>
                <li>
                    <span class="font-bold text-gray-900">Availability:</span> 
                    @if($book->available)
                        <span class="text-green-600 font-semibold">Available</span>
                    @else
                        <span class="text-red-600 font-semibold">Unavailable</span>
                    @endif
                </li>
            </ul>
        </div>
    </div>

    <div class="mt-8 flex justify-start">
        <a href="{{ route('books.index') }}">
            <x-button class="w-auto">
                Back to Book List
            </x-button>
        </a>
    </div>
    
</div>

@endsection