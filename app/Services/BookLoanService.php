<?php

namespace App\Services;
use App\Models\BookLoan;
use Illuminate\Http\Request;

class BookLoanService
{
    public function getAllBookLoans(Request $request)
    {
        return BookLoan::query()->FilterBySearch($request)->FilterByAttribute($request, ['status'])->FilterByDate($request)->latest()->paginate(15);
    }
}