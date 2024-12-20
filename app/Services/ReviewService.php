<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewService
{
    public function getBookReviews(Book $book)
    {
        return Review::where('book_id', $book->id)->with('user')->latest()->get();
    }

    public function createReview(array $credentials): void
    {
        try
        {
            $credentials['user_id'] = Auth::id();
            Review::create($credentials);
        }
        catch (\Exception $th)
        {
            abort(500, 'An error occurred while creating your review.');
        }
    }
}