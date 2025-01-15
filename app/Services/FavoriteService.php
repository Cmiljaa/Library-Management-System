<?php

namespace App\Services;

use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FavoriteService
{
    public function getFavorite(Book $book): User|null
    {
        return Auth::check() ? $book->favoritedBy()->where('user_id', Auth::user()->id)->first() : null;
    }

    public function toogleFavorite(Book $book): void
    {
        if (Auth::user()->favoriteBooks()->where('book_id', $book->id)->exists())
        {
            Auth::user()->favoriteBooks()->detach($book->id);
        }
        else
        {
            Auth::user()->favoriteBooks()->attach($book->id);
        }
    }
}