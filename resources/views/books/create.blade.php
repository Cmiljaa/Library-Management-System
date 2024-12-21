@extends('layouts.form')
@section('form')
    @section('heading', 'Create Book')

    <form class="mt-6 space-y-4" action="{{ route('books.store') }}" method="POST">
        @csrf
        <div>
            <x-label for="title">Title</x-label>
            <x-input name="title" id="title" placeholder="Harry Potter" required />
        </div>

        <div>
            <x-label for="author">Author</x-label>
            <x-input name="author" id="author" placeholder="J. K. Rowling" required />
        </div>

        <div>
            <x-label class="mb-2" for="genre">Genre</x-label>
            <x-select name="genre" :array="config('book.genres')" required />
        </div>

        <div>
            <x-label class="mb-2" for="language">Language</x-label>
            <x-select name="language" :array="config('book.languages')" required />
        </div>

        <div>
            <x-label class="mb-2" for="availability">Availability</x-label>
            <x-select name="availability" :array="config('book.availability')" required />
        </div>

        <div>
            <x-label for="description">Description</x-label>
            <x-textarea name="description" id="description"></x-textarea>
            
        </div>

        <div>
            <x-button>
                Submit
            </x-button>
        </div>
    </form>
@endsection