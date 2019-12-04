<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\DailyReport as Report;

class DailyReportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('daily_reports')->truncate();
        factory(Report::class, 30)->create();
    }
}
