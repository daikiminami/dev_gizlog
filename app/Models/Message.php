<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'user_id',
        'recipient_user_id',
        'title',
        'content'
    ];

    // conversationとの紐付け
    public function conversation() {
        return $this->belongsTo(Conversation::class);
    }
    
    // ユーザーとの紐付け
    public function user() {
        return $this->belongsTo(User::class);
    }
}
