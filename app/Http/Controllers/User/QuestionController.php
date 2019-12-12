<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\SearchQuestionsRequest;
use App\Http\Requests\User\QuestionsRequest;
use App\Models\Question;
use App\Models\TagCategory;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    private $question;

    public function __construct(Question $question, TagCategory $tagCategory, Comment $comment)
    {
        $this->middleware('auth');
        $this->question = $question;
        $this->tagCategory = $tagCategory;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SearchQuestionsRequest $request)
    {

        $input = $request->only('search_word', 'tag_category_id');
        $questions = $this->question->getQuestion($input);
        $currentUser = Auth::user();
        $categories = $this->tagCategory->all();
        return view('user.question.index', compact('questions', 'currentUser', 'categories', 'input'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->tagCategory->all();
        return view('user.question.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionsRequest $questionsRequest)
    {
        $input = $questionsRequest->validated();
        $input['user_id'] = Auth::id();
        $this->question->fill($input)->save();
        return redirect()->route('question.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currentUser = Auth::user();
        $question = $this->question->find($id);
        return view('user.question.show', compact('question', 'currentUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->question->find($id);
        $categories = $this->tagCategory->all();
        return view('user.question.edit', compact('question', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionsRequest $questionsRequest, $id)
    {
        $input = $questionsRequest->validated();
        $input['user_id'] = Auth::id();
        $this->question->fill($input)->save();
        return redirect()->route('question.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->question->find($id)->delete();
        return redirect()->route('question.index');
    }

    public function mypage()
    {
        $currentUser = Auth::user();
        $questions = $this->question->getCurrentUserQuestion($currentUser['id']);
        return view('user.question.mypage', compact('questions', 'currentUser'));
    }

    /**
     * 質問の新規作成・更新前の確認画面
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function confirm(QuestionsRequest $questionsRequest, $id = null)
    {
        $inputs = $questionsRequest->all();
        $questionId = $id;
        $category = $this->tagCategory->find($inputs['tag_category_id']);
        return view('user.question.confirm', compact('inputs', 'category', 'questionId'));
    }
}
