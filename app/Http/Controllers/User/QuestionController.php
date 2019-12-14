<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\QuestionRequest;
use App\Models\Question;
use App\Models\TagCategory;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    private $question;

    public function __construct(Question $question, TagCategory $tagCategory)
    {
        $this->middleware('auth');
        $this->question = $question;
        $this->tagCategory = $tagCategory;
    }
    /**
     * 質問一覧表示
     *
     * @param  \Illuminate\Http\Request\Request  $request
     * @return View
     */
    public function index(Request $request)
    {
        $input = $request->only('search_word', 'tag_category_id');
        $questions = $this->question->getQuestion($input);
        $currentUser = Auth::user();
        $categories = $this->tagCategory->all();
        return view('user.question.index', compact('questions', 'currentUser', 'categories', 'input'));
    }

    /**
     * 質問新規作成ページの表示
     *
     */
    public function create()
    {
        $categories = $this->tagCategory->all();
        return view('user.question.create', compact('categories'));
    }

    /**
     * 質問掲示板の保存
     *
     * @param  \Illuminate\Http\Request\QuestionRequest  $rquestionRequest
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $questionRequest)
    {
        $input = $questionRequest->validated();
        $input['user_id'] = Auth::id();
        $this->question->fill($input)->save();
        return redirect()->route('question.index');
    }

    /**
     * 質問の詳細ページ
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {
        $question = $this->question->find($id);
        $currentUser = Auth::user();
        $comments = $question->comments;
        return view('user.question.show', compact('question', 'currentUser', 'comments'));
    }

    /**
     * 質問編集
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id)
    {
        $question = $this->question->find($id);
        $categories = $this->tagCategory->all();
        return view('user.question.edit', compact('question', 'categories'));
    }

    /**
     * 質問の更新
     *
     * @param  \Illuminate\Http\Request\QuestionRequest  $requestionRequest
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $questionRequest, $id)
    {
        $input = $questionRequest->validated();
        $input['user_id'] = Auth::id();
        $this->question->find($id)->fill($input)->save();
        return redirect()->route('question.index');

    }

    /**
     * 質問の削除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->question->find($id)->delete();
        return redirect()->route('question.index');
    }

    /**
     * ユーザーページの表示
     *
     * @return View
     */
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
    public function confirm(QuestionRequest $questionRequest, $id = null)
    {
        $inputs = $questionRequest->all();
        $questionId = $id;
        $category = $this->tagCategory->find($inputs['tag_category_id']);
        return view('user.question.confirm', compact('inputs', 'category', 'questionId'));
    }
}
