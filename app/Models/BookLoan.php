<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class BookLoan extends Model
{
    /** @use HasFactory<\Database\Factories\BookLoanFactory> */
    use HasFactory, Sortable, Filterable;

    protected $fillable = ['user_id', 'book_id', 'status', 'borrow_date', 'return_date', 'status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function scopeFilterByDate($query, Request $request)
    {
        $borrowDate = $request->borrow_date;
        $returnDate = $request->return_date;

        if ($request->filled('borrow_date') && $request->filled('return_date')) {

            $query->where('borrow_date', '>=', $borrowDate)
                ->where('return_date', '<=', $returnDate);
        }
        else if ($request->filled('borrow_date')) {
            $query->where('borrow_date', '>=', $borrowDate);
        }
        else if ($request->filled('return_date')) {
            $query->where('return_date', '<=', $returnDate);
        }
    }

    public function scopeFilterBySearch($query, Request $request)
    {
        $search = '%' . $request->search . '%';
        if($request->filled('search'))
        {
            $query->whereHas('book', function ($query) use ($search) {
                $query->where('title', 'like', $search);
            })
            ->orWhereHas('user', function ($query) use ($search) {
                $query->where('first_name', 'like', $search)
                      ->orWhere('last_name', 'like', $search);
            });
        }
    }
}
