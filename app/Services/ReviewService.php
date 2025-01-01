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
        $credentials['user_id'] = Auth::id();
        Review::create($credentials);
    }

    public function updateReview(array $credentials, Review $review)
    {
        $review->update($credentials);
    }

    public function deleteReview(Review $review): void
    {
        $review->delete();
    }
}