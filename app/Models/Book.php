<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    public function reviews() :HasMany
    {
        return $this->hasMany(Review::class);
    }
    
    public function scopeFilterByAttribute($query, Request $request, array $attributes)
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
            $query->where('title', 'like', '%' . $request->search . '%')
            ->orWhere('description', 'like', '%' . $request->search . '%')
            ->orWhere('author', 'like', '%' . $request->search . '%');;
        }
    }

}
