<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\FavoriteService;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function __construct(protected readonly FavoriteService $favoriteService) {}

    public function toggleFavorite(Book $book)
    {
        $this->favoriteService->toogleFavorite($book);

        return redirect(route('books.show', $book));
    }
}
