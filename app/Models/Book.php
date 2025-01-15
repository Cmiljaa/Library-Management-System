<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory, Sortable, Filterable;

    protected $fillable = ['title', 'author', 'genre', 'language', 'availability', 'description'];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function book_loans(): HasMany
    {
        return $this->hasMany(BookLoan::class);
    }

    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function scopeFilterBySearch($query, Request $request)
    {
        if($request->filled('search'))
        {
            $search = '%' . $request->search . '%';
            $query->where('title', 'like', $search)
            ->orWhere('description', 'like', $search)
            ->orWhere('author', 'like', $search);
        }
    }

}
