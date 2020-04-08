<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table = 'provincia';

    // Dynamic query builder method
    public function scopeCustomFiltering($query, $filters)
    {
        return $filters->reduce(function($extendedQuery, $filter) {
            return $extendedQuery->where($filter['column'], $filter['op'], $filter['value']); 
        }, $query);
    }

    // Dynamic query builder method
    public function scopeCustomJoining($query, $joins)
    {
        return $joins->reduce(function($extendedQuery, $join) {
            return $extendedQuery->join($join['fkTable'],$join['id'], $join['op'], $join['fkID']); 
        }, $query);
    }
}
