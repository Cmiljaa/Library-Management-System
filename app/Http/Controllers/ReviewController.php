<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Services\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;        
    }

    public function store(ReviewRequest $request)
    {
        $this->reviewService->createReview($request->validated());
        return redirect()->back()->with('success', 'Review added successfully');
    }
    
    public function update(ReviewRequest $request, Review $review)
    {
        $this->reviewService->updateReview($request->validated(), $review);
        return redirect()->back()->with('success', 'Review updated successfully');
    }
    
    public function destroy(Review $review)
    {
        $this->reviewService->deleteReview($review);
        return redirect()->back()->with('success', 'Review deleted successfully');
    }
}
