<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    protected $fillable =
    [
        'reporting_time',
        'user_id',
        'title',
        'content'
    ];

    protected $dates =
    [
        'reporting_time',
        'created_at',
        'updated_at',
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
