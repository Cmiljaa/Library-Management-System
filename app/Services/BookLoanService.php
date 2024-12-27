<?php

namespace App\Services;
use App\Models\BookLoan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class BookLoanService
{
    public function getAllBookLoans(Request $request)
    {
        return BookLoan::query()->FilterBySearch($request)->FilterByAttribute($request, ['status'])->FilterByDate($request)->latest()->paginate(15);
    }

    public function createBookLoan(array $credentials)
    {
        BookLoan::create($credentials);
    }

    public function updateBookLoan(array $credentials, BookLoan $bookLoan)
    {
        $credentials['status'] = $this->updateBookStatus($bookLoan);
        $bookLoan->update($credentials);
    }

    public function updateBookStatus(BookLoan $bookLoan): string
    {
        if($bookLoan->return_date === null)
        {
            return now() > Carbon::parse($bookLoan->borrow_date)->copy()->addMonth() ? 'overdue' : 'borrowed';
        }
        else
        {
            return 'returned';
        }
    }
}