<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;
    
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
    
}
