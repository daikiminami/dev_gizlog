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

    public function scopeFilterMonth($query, $input)
    {
        if(isset($input['search_month']))
        {
            return $query->where('reporting_time', 'like', $input['search_month'].'%');
        }
    }

    public function getDailyReportList($input, $id)
    {
        return DailyReport::where('user_id', $id)
                            ->filterMonth($input)
                            ->orderBy('reporting_time', 'desc')
                            ->paginate(10);
    }
}
