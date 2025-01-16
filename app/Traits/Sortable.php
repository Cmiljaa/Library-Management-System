<?php

namespace App\Traits;

trait Sortable
{
    public function scopeApplySorting($query, $sort, array $allowedColumns)
    {
        $sort = $sort ?? 'created_at, desc';

        if(in_array($sort, array_keys($allowedColumns)))
        {
            [$column, $direction] = explode(', ', $sort);
            return $query->orderBy($column, $direction);
        }
        else
        {
            abort(403, 'Invalid sort parameter');
        }
    }
}
