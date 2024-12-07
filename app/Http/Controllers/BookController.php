<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $attributes = ['language', 'genre'];

        $books = Book::query()->FilterBySearch($request)->FilterByAttribute($request, $attributes)->latest()->paginate(10);

        return view('books.index', ['books' => $books]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Book $book)
    {
        $reviews = Review::where('book_id', $book->id)->with('user')->get();
        return view('books.show', ['book' => $book, 'reviews' => $reviews]);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
