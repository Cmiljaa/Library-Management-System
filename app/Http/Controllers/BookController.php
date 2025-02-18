<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Favorite;
use App\Services\BookService;
use App\Services\FavoriteService;
use App\Services\ReviewService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookController extends Controller
{
    public function __construct(protected readonly BookService $bookService) {}

    public function index(Request $request): View
    {
        return view('books.index', ['books' => $this->bookService->getAllBooks($request)]);
    }

    public function create(): View
    {
        return view('books.create');
    }

    public function store(BookRequest $request): RedirectResponse
    {
        return redirect(route('books.show', $this->bookService->createBook($request->validated())))
        ->with('success', 'Book created successfully');
    }

    public function show(Book $book, ReviewService $reviewService, FavoriteService $favoriteService): View
    {
        return view('books.show', [
            'book' => $book,
            'favorite' => $favoriteService->getFavorite($book),
            'reviews' => $reviewService->getBookReviews($book)
        ]);
    }

    public function edit(Book $book): View
    {
        return view('books.edit', ['book' => $book]);
    }

    public function update(BookRequest $request, Book $book): RedirectResponse
    {
        $this->bookService->editBook($request->validated(), $book);
        return redirect(route('books.show', $book))->with('success', 'Book update successfully');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $this->bookService->deleteBook($book);
        return redirect(route('books.index'))->with('success', 'Book deleted successfully');
    }
}
