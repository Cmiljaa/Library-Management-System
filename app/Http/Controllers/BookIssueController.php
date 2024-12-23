<?php

namespace App\Http\Controllers;

use App\Services\BookIssueService as ServicesBookIssueService;
use Illuminate\Http\Request;

class BookIssueController extends Controller
{
    protected $bookIssueService;

    public function __construct(ServicesBookIssueService $bookIssueService)
    {
        $this->bookIssueService = $bookIssueService;
    }
    
    public function index()
    {
        return view('book_issues.index', ['book_issues' => $this->bookIssueService->getAllBookIssues()]);
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
