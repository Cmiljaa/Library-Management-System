<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\BookService;
use App\Services\ReviewService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        return view('books.index', ['books' => BookService::getAllBooks($request)]);
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Book $book)
    {
        return view('books.show', ['book' => $book, 'reviews' => ReviewService::getBookReviews($book)]);
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
