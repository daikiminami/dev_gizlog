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
        'updated_at',
        'created_at',
        'deleted_at'
    ];

    public function scopeFilterMonth($query, $filter)
    {
        if(!empty($filter['search-month']) && $filter['search-month'] !== null)
        {
            $month = $filter['search-month'];
            return $query->where('reporting_time', 'like', $month.'%');
        }
    }

    public function getByFilterAndUser($filter, $id)
    {
        return $this->where('user_id', $id)
                    ->filterMonth($filter)
                    ->paginate(5);
    }
}
