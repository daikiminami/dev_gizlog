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

    public function getbyUserId($id)
    {
        return $this->where('user_id', $id)->paginate(5);
    }

    public function getbyFilterMonthAndUserId($filterMonth, $id)
    {
        return $this->where('user_id', $id)->where('reporting_time', 'like', $filterMonth.'%')->paginate(5);
    }

    
}
