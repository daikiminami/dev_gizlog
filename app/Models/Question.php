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

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function tagCategory()
    {
        return $this->belongsTo('App\Models\TagCategory', 'tag_category_id');
    }

    public function comment()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function getUserQuestion($id)
    {
        return $this->where('user_id', $id)->get();
    }
}

