<?php 

namespace App\Services;

use App\Models\Book;
use Illuminate\Http\Request;

class BookService
{
    public function getAllBooks(Request $request, $available = null)
    {
        $query = Book::query()->withAvg('reviews', 'rating')->FilterBySearch($request)->FilterByAttribute($request, ['genre', 'language'])
        ->when(!is_null($available), function ($query) use ($available) {
            $query->where('availability', (bool)$available);
        })->latest();

        return $query->paginate(15);
    }

    public function createBook(array $credentials): Book
    {
        return Book::create($credentials);
    }

    public function editBook(array $credentials, Book $book): void
    {
        $book->update($credentials);
    }

    public function deleteBook(Book $book): void
    {
        $book->delete();
    }

    public function changeAvailability(Book $book): void
    {
        $book->availability =  !$book->availability;
        $book->save();
    }
}