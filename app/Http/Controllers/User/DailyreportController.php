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
    public function __construct(DailyReport $instanceClass)
    {
        $this->middleware('auth');
        $this->report = $instanceClass;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ResearchDailyReportRequest $request)
    {
        $filterMonth = $request->query('search-month');
        $userId = Auth::id();
        if ($filterMonth === null) {
            $reports = $this->report->getbyUserId($userId);
        } else {
            $reports = $this->report->getbyFilterMonthAndUserId($filterMonth, $userId);
        }
        return view('user.daily_report.index', compact('reports', 'filterMonth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.daily_report.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(DailyReportRequest $request)
    {
        $input = $request->all();
        $this->report->fill($input)->save();
        return redirect()->route('report.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = $this->report->find($id);
        return view('user.daily_report.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = $this->report->find($id);
        return view('user.daily_report.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DailyReportRequest $request, $id)
    {
        $input = $request->all();
        $this->report->find($id)->fill($input)->save();
        return redirect()->route('report.index');
    }

    /**
     * Remove the specified resource from storage.
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
