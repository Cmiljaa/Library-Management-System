<?php

namespace App\Models;

use App\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory, Sortable;

    protected $fillable = ['title', 'author', 'genre', 'language', 'availability', 'description'];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function book_loans(): HasMany
    {
        return $this->hasMany(BookLoan::class);
    }
    
    public function scopeFilterByAttribute($query, Request $request, array $attributes): void
    {
        foreach ($attributes as $key)
        {
            if($request->filled($key))
            {
                $query->where($key, $request->$key);
            }
        }
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
