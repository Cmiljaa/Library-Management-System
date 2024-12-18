<?php 

namespace App\Services;

use App\Models\Book;
use Illuminate\Http\Request;

class BookService
{
    public function getAllBooks(Request $request)
    {
        return Book::query()->withAvg('reviews', 'rating')->FilterBySearch($request)->FilterByAttribute($request, ['genre', 'language'])->latest()->paginate(10);
    }

    public function createBook(array $credentials): Book
    {
        try
        {
            return Book::create($credentials);
        }
        catch (\Exception $th)
        {
            abort(500, 'An error occurred while creating a book.');
        }
    }

    public function editBook(array $credentials, Book $book): void
    {
        $book->update($credentials);
    }

}