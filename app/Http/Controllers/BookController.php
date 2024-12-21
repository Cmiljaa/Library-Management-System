<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Review;
use App\Services\BookService;
use App\Services\ReviewService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $bookService, $reviewService;

    public function __construct(BookService $bookService, ReviewService $reviewService)
    {
        $this->bookService = $bookService;
        $this->reviewService = $reviewService;
    }

    public function index(Request $request)
    {
        return view('books.index', ['books' => $this->bookService->getAllBooks($request)]);
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(BookRequest $request)
    {
        return redirect(route('books.show', $this->bookService->createBook($request->validated())))
        ->with('success', 'Book created successfully');
    }

    public function show(Book $book)
    {
        return view('books.show', ['book' => $book, 'reviews' => $this->reviewService->getBookReviews($book)]);
    }

    public function edit(Book $book)
    {
        return view('books.edit', ['book' => $book]);
    }

    public function update(BookRequest $request, Book $book)
    {
        $this->bookService->editBook($request->validated(), $book);
        return redirect(route('books.show', $book))->with('success', 'Book update successfully');
    }

    public function destroy(Book $book)
    {
        $this->bookService->deleteBook($book);
        return redirect(route('books.index'))->with('success', 'Book deleted successfully');
    }
}
