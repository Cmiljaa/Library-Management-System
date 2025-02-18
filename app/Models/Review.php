<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;

    protected $fillable = ['book_id', 'user_id', 'rating', 'description'];

    public function books() :BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
