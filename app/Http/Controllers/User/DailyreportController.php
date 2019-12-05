<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\DailyReportRequest;
use App\Http\Requests\User\ResearchDailyReportRequest;
use App\Models\DailyReport;
use Auth;

class DailyreportController extends Controller
{
    private $report;
    public function __construct(DailyReport $dailyReport)
    {
        $this->middleware('auth');
        $this->report = $dailyReport;
    }

    /**
     * 指定のユーザのレポートを一覧で取得する
     *
     * @param  \Illuminate\Http\Request\DailyReportRequest  $request
     * @return View
     */
    public function index(ResearchDailyReportRequest $request)
    {
        $userId = Auth::id();
        $input = $request->validated();
        $reports = $this->report->getDailyReportList($input, $userId);
        return view('user.daily_report.index', compact('reports', 'input'));        
    }

    /**
     * レポートの新規作成
     *
     * @return View
     */
    public function create()
    {
        return view('user.daily_report.create');
    }

    /**
     * ユーザーからの情報を取得し、DBに保存
     *
     * @param  \Illuminate\Http\Request\DailyReportRequest  $request
     * @return View
     */
    public function store(DailyReportRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $this->report->fill($input)->save();
        return redirect()->route('report.index');
    }

    /**
     * Userのレポートの詳細ページの取得
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {
        $report = $this->report->find($id);
        return view('user.daily_report.show', compact('report'));
    }

    /**
     * Userのレポートの情報を取得し、編集ページに移動
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id)
    {
        $report = $this->report->find($id);
        return view('user.daily_report.edit', compact('report'));
    }

    /**
     * Userのレポートの更新
     *
     * @param  \Illuminate\Http\Request\DailyReportRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DailyReportRequest $request, $id)
    {
        $input = $request->only('title', 'content', 'reporting_time');
        $this->report->find($id)->fill($input)->save();
        return redirect()->route('report.index');
    }

    /**
     * Userのレポートの削除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->report->find($id)->delete();
        return redirect()->route('report.index');
    }
}
