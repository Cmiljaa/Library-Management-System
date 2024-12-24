<?php

namespace App\Services;
use App\Models\BookLoan;

class BookLoanService
{
    public function getAllBookLoans()
    {
        return BookLoan::with(['user', 'book'])->latest()->paginate(15);
    }
}