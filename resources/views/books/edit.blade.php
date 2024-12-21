@extends('layouts.form')
@section('form')
    @section('heading', 'Edit Book')

    <form class="mt-6 space-y-4" action="{{ route('books.update', $book) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <x-label for="title">Title</x-label>
            <x-input name="title" value="{{ $book->title }}" id="title" placeholder="Harry Potter" required />
        </div>

        <div>
            <x-label for="author">Author</x-label>
            <x-input name="author" value="{{ $book->author }}" id="author" placeholder="J. K. Rowling" required />
        </div>

        <div>
            <x-label class="mb-2" for="genre">Genre</x-label>
            <x-select name="genre" selected="{{ $book->genre }}" :array="config('book.genres')" required />
        </div>

        <div>
            <x-label class="mb-2" for="language">Language</x-label>
            <x-select name="language" selected="{{ $book->language }}" :array="config('book.languages')" required />
        </div>

        <div>
            <x-label class="mb-2" for="availability">Availability</x-label>
            <x-select name="availability" selected="{{ $book->availability }}" :array="config('book.availability')" required />
        </div>

        <div>
            <x-label for="description">Description</x-label>
            <x-textarea  name="description" id="description">{{ $book->description }}</x-textarea>
        </div>

        <div>
            <x-button>
                Submit
            </x-button>
        </div>
    </form>
@endsection