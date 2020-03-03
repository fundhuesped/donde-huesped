<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Places extends Model
{
    protected $table = 'places';
    protected $primaryKey = 'placeId';

    // Dynamic query builder method
    public function scopeCustomFiltering($query, $filters)
    {
        return $filters->reduce(function($extendedQuery, $filter) {
            return $extendedQuery->where($filter['column'], $filter['op'], $filter['value']); 
        }, $query);
    }

}
