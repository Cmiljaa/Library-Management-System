<?php

namespace App\Http\Controllers;

use App\Services\BookLoanService as ServicesBookLoanService;
use Illuminate\Http\Request;

class BookLoanController extends Controller
{
    protected $BookLoanService;

    public function __construct(ServicesBookLoanService $BookLoanService)
    {
        $this->BookLoanService = $BookLoanService;
    }
    
    public function index()
    {
        return view('book_loans.index', ['book_loans' => $this->BookLoanService->getAllBookLoans()]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
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
