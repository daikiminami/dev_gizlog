<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    // senderユーザーとの紐付け
    public function senderUser() {
        return $this->hasOne(User::class, 'id', 'sender_user_id');
    }
    
    // recipientユーザーとの紐付け
    public function recipientUser() {
        return $this->hasOne(User::class, 'id', 'recipient_user_id');
    }
    
    // DM相手を引っ張るためにotherUserを用意
    public function otherUser() {
        $user_id = Auth::id();
        $other_key = '';
        if ($user_id === $this->sender_user_id) {
            $other_key = 'recipient_user_id';
        } else if ($user_id === $this->recipient_user_id) {
            $other_key = 'sender_user_id';
        }
        return $this->hasOne(User::class, 'id', $other_key);
    }
    
    // メッセージとの紐付け
    public function messages() {
        return $this->hasMany(Message::class);
    }
}
