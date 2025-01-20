<?php

namespace App\Services;

use App\Models\Book;
use App\Models\BookLoan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookLoanService
{
    public function __construct(protected readonly SettingService $settingService) {}

    public function getAllBookLoans(Request $request)
    {
        return BookLoan::query()
            ->FilterBySearch($request)
            ->FilterByAttribute($request, ['status'])
            ->applySorting($request->sort, config('sort.book_loan'))
            ->FilterByDate($request)->paginate(15)->appends($request->only(['sort', 'borrow_date', 'return_date', 'status', 'search']));
    }

    public function createBookLoan(array $credentials, BookService $bookService): void
    {
        $user = User::findOrFail($credentials['user_id']);
        $book = Book::findOrFail($credentials['book_id']);

        $this->checkUserOverdueFees($user);

        if (!$book->availability) {
            throw new \Exception("Book is not available");
        } elseif ($this->getUserBooks($user)->total() >= $this->settingService->getSettingValue('max_books')) {
            throw new \Exception("User already has  {$this->settingService->getSettingValue('max_books')} book loans");
        } else {
            $bookService->changeAvailability($book);
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
        if ($bookLoan->return_date === null) {
            return Carbon::now()->timezone(config('app.timezone')) > Carbon::parse($bookLoan->borrow_date)->copy()->addDays($this->settingService->getSettingValue('loan_duration'))
                ->timezone(config('app.timezone')) ? 'overdue' : 'borrowed';
        } else {
            return 'returned';
        }
    }

    private function checkUserOverdueFees(User $user): void
    {
        if ($user->notifications->count() > 0) {
            throw new \Exception("User needs to pay all overdue fees");
        }
    }
}
