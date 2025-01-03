<?php

namespace App\Services;

use App\Models\Book;
use App\Models\BookLoan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class BookLoanService
{
    protected $bookService, $userService;

    public function __construct(BookService $bookService, UserService $userService)
    {
        $this->bookService = $bookService;
        $this->userService = $userService;
    }

    public function getAllBookLoans(Request $request)
    {
        return BookLoan::query()->FilterBySearch($request)->FilterByAttribute($request, ['status'])
        ->applySorting($request->sort, config('sort.book_loan'))->FilterByDate($request)->latest()->paginate(15)->appends(['sort' => $request->sort]);
    }

    public function createBookLoan(array $credentials)
    {
        $user = User::findOrFail($credentials['user_id']);
        $book = Book::findOrFail($credentials['book_id']);

        $this->checkUserOverdueFees($user);

        if(!$book->availability)
        {
            throw new \Exception("Book is not available");
        }
        elseif($this->getUserBooks($user)->total() >= 3)
        {
            throw new \Exception("User already has 3 book loans");
        }
        else
        {
            $this->bookService->changeAvailability($book);
            BookLoan::create($credentials);
        }
    }

    public function updateBookLoan(array $credentials, BookLoan $bookLoan): void
    {
        $this->checkUserOverdueFees(User::findOrFail($credentials['user_id']));

        $bookLoan->update($credentials);

        $bookLoan->status = $this->updateBookLoanStatus($bookLoan);
        $bookLoan->save();
    }

    public function getUserBooks(User $user)
    {
        return BookLoan::with(['book', 'user:id,first_name,last_name'])->where('user_id', $user->id)
        ->latest()->paginate(15);
    }

    public function updateBookLoanStatus(BookLoan $bookLoan): string
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

    private function checkUserOverdueFees(User $user)
    {
        if($user->notifications->count() > 0)
        {
            throw new \Exception("User needs to pay all overdue fees");
        }
    }
}