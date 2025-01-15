<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\FavoriteService;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    protected $favoriteService;

    public function __construct(FavoriteService $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }

    public function toggleFavorite(Book $book)
    {
        $this->favoriteService->toogleFavorite($book);

        return redirect(route('books.show', $book));
    }
}
