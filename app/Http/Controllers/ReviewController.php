<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Services\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;        
    }

    public function index()
    {
        //
    }

    public function store(ReviewRequest $request)
    {
        $this->reviewService->createReview($request->validated());
        return redirect()->back()->with('success', 'Review added successfully');
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
