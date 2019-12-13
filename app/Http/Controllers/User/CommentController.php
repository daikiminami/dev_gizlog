<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function __construct(Comment $comment, Question $question)
    {
        $this->middleware('auth');
        $this->comment = $comment;
        $this->question = $question;
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $this->comment->fill($input)->save();
        return redirect()->route('question.show', $input['question_id']);
    }
}
