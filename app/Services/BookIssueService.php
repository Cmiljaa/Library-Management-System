<?php

namespace App\Services;
use App\Models\BookIssue;

class BookIssueService
{
    public function getAllBookIssues()
    {
        return BookIssue::with(['user', 'book'])->latest()->paginate(15);
    }
}