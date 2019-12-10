<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'user_id',
        'tag_category_id',
        'title',
        'content'
    ];

    protected $dates = 
    [
        'created_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tagCategory()
    {
        return $this->belongsTo(TagCategory::class, 'tag_category_id');
    }

    public function comment()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function getCurrentUserQuestion($id)
    {
        return $this->where('user_id', $id)->get();
    }
}

