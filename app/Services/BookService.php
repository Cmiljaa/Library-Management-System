<?php 

namespace App\Services;

use App\Models\Book;
use Illuminate\Http\Request;

class BookService
{
    public function getAllBooks(Request $request, $available = null)
    {
        return Book::query()
            ->withAvg('reviews', 'rating')
            ->withCount(['reviews', 'book_loans'])
            ->filterBySearch($request)
            ->filterByAttribute($request, ['genre', 'language'])
            ->when(!is_null($available), function ($query) use ($available) {
                $query->where('availability', (bool) $available);
            })
            ->applySorting($request->sort, config('sort.book'))
            ->paginate(15)
            ->appends($request->only(['genre', 'language', 'search', 'sort']));
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