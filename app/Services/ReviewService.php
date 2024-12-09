<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Review;

class ReviewService
{
    public static function getBookReviews(Book $book)
    {
        return Review::where('book_id', $book->id)->with('user')->get();
    }
}