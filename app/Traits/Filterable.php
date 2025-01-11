<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait Filterable
{
    public function scopeFilterByAttribute($query, Request $request, array $attributes, $matchType = 'exact')
    {
        foreach ($attributes as $key)
        {
            if($request->filled($key))
            {
                if($matchType === 'exact')
                    $query->where($key, $request->$key);
                elseif($matchType === 'like')
                    $query->where($key, 'like', '%' . $request->$key . '%');
            }
        }
    }
}