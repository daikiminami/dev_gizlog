<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DailyReportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('daily_reports')->insert([
            'id' => 300,
            'user_id' => 2,
            'title' => '他のUserのreport',
            'content' => '他のUserのreport',
            'reporting_time' => Carbon::create(2018, 1, 1),
            'updated_at' => Carbon::create(2018, 1, 1),
            'created_at' => Carbon::create(2018, 1, 1),
            'deleted_at' => null
        ]);
    }
}
