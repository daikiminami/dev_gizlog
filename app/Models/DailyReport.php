<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    protected $fillable =
    [
        'user_id',
        'title',
        'content',
        'reporting_time',
    ];

    protected $dates =
    [
        'reporting_time',
        'deleted_at'
    ];

    public function scopeFilterMonth($query, $filter)
    {
        if(isset($filter['search-month']))
        {
            return $query->where('reporting_time', 'like', $filter['search-month'].'%');
        }
    }

    public function getByFilterAndUser($filter, $id)
    {
        return DailyReport::where('user_id', $id)
                            ->filterMonth($filter)
                            ->orderBy('reporting_time', 'desc')
                            ->paginate(10);
    }
}
