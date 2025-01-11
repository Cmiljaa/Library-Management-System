<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookLoanRequest;
use App\Models\BookLoan;
use App\Services\BookLoanService;
use App\Services\BookService;
use App\Services\NotificationService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookLoanController extends Controller
{
    protected BookLoanService $bookLoanService;
    protected BookService $bookService;
    protected UserService $userService;
    protected NotificationService $notificationService;

    public function __construct(BookLoanService $bookLoanService, BookService $bookService, UserService $userService, NotificationService $notificationService)
    {
        $this->bookLoanService = $bookLoanService;
        $this->bookService = $bookService;
        $this->userService = $userService;
        $this->notificationService = $notificationService;
    }
    
    public function index(Request $request): View
    {
        return view('book_loans.index', ['book_loans' => $this->bookLoanService->getAllBookLoans($request)]);
    }

    public function show(BookLoan $bookLoan): View
    {
        return view('book_loans.show', ['book_loan' => $bookLoan, 'notification' => $this->notificationService->getNotification($bookLoan->id, $bookLoan->user)]);
    }

    public function create(Request $request): View
    {
        return view('book_loans.create', ['users' => $this->userService->getUsersByRoles($request), 'books' => $this->bookService->getAllBooks($request)]);
    }

    public function store(BookLoanRequest $request): RedirectResponse
    {
        try
        {
            $this->bookLoanService->createBookLoan($request->validated());
            return redirect(route('book_loans.index'))->with('success', 'Book loan added successfully');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(BookLoan $bookLoan): View
    {
        return view('book_loans.edit', ['book_loan' => $bookLoan]);
    }

    public function update(BookLoanRequest $request, BookLoan $bookLoan): RedirectResponse
    {
        try
        {
            $this->bookLoanService->updateBookLoan($request->validated(), $bookLoan);
            return redirect(route('book_loans.index'))->with('success', 'Book loan updated successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
