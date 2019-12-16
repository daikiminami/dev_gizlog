<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Auth;

class MessageController extends Controller
{
    private $message;

    public function __construct(Message $message, User $user)
    {
        $this->middleware('auth');
        $this->message = $message;
        $this->user = $user;
    }

    public function index()
    {
        
        $messages = $this->message->all();
        return view('user.message.index', compact('messages'));
    }

    public function create()
    {
        $users = $this->user->all();
        return view('user.message.create', compact('users'));
    }

    public function store(Request $request)
    {

        $input = $request->all();
        $input['user_id'] = Auth::id();
        $this->message->fill($input)->save();
        return redirect()->route('user.message.index');
    }
}
