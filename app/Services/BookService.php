<?php 

namespace App\Services;

use App\Models\Book;
use Illuminate\Http\Request;

class BookService
{
    public function getAllBooks(Request $request)
    {
        return Book::query()->withAvg('reviews', 'rating')->FilterBySearch($request)->FilterByAttribute($request, ['genre', 'language'])->latest()->paginate(10);
    }
}