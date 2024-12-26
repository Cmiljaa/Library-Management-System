<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookLoanRequest;
use App\Models\BookLoan;
use App\Services\BookLoanService as ServicesBookLoanService;
use App\Services\BookService;
use App\Services\UserService;
use Illuminate\Http\Request;

class BookLoanController extends Controller
{
    protected $bookLoanService, $bookService, $userService;

    public function __construct(ServicesBookLoanService $bookLoanService, BookService $bookService, UserService $userService)
    {
        $this->bookLoanService = $bookLoanService;
        $this->bookService = $bookService;
        $this->userService = $userService;
    }
    
    public function index(Request $request)
    {
        return view('book_loans.index', ['book_loans' => $this->bookLoanService->getAllBookLoans($request)]);
    }

    public function create(Request $request)
    {
        return view('book_loans.create', ['users' => $this->userService->getAllMembers($request), 'books' => $this->bookService->getAllBooks($request)]);
    }

    public function store(BookLoanRequest $request)
    {
        $this->bookLoanService->createBookLoan($request->validated());
        return redirect(route('book_loans.index'))->with('success', 'Book loan added successfully');
    }

    public function update(BookLoan $bookLoan)
    {
        
    }
}
