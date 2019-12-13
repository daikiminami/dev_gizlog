<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'tag_category_id',
        'title',
        'content'
    ];

    protected $dates = 
    [
        'created_at',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tagCategory()
    {
        return $this->belongsTo(TagCategory::class, 'tag_category_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeFilterCategory($query, $input)
    {
        return (empty($input['tag_category_id']))? $query : $query->where('tag_category_id', $input['tag_category_id']);  
    
    }

    public function scopeFilterWord($query, $input)
    {

        if (isset($input['search_word'])) {
            return $query->where('title', 'like', '%'.$input['search_word'].'%');
        }
    }

    public function getQuestion($input)
    {
        return $this->with('user', 'tagCategory', 'comments')
                    ->filterCategory($input)
                    ->filterWord($input)
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
    }

    public function getCurrentUserQuestion($id)
    {
        return $this->with('comments', 'tagCategory')
                    ->where('user_id', $id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
    }
}

