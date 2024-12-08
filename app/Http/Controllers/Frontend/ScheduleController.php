<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function index()
    {
        $scheduleCheck = DB::select('select schedule from systems limit 1');
        $season = DB::select("select season from systems limit 1");
        $babak = DB::select("select babak from systems limit 1");
        $babak = $babak[0]->babak;
        $season = $season[0]->season;
        // dd($scheduleCheck[0]->schedule == 1);
        if ($scheduleCheck[0]->schedule == 0) {
            return view("frontend.schedule.close");
        } else {
            if ($babak == 'regular') {
                $scheduleRegular = DB::select("select schedules.*, timA.short_squad as timA, timB.short_squad as timB, timA.logo as logoA, timB.logo as logoB from schedules inner join tims as timA on timA.id = schedules.id_timA inner join tims as timB on timB.id = schedules.id_timB where schedules.babak = ?", [$babak]);
                $day = DB::select("select day from schedules order by day desc limit 1");
                // dd($day);
                $standing = DB::select('select standings.id, standings.id_grup, standings.game, standings.win, standings.lose, standings.winrate, standings.poin, tims.squad,grups.grup from standings inner join tims on tims.id = standings.id_tim inner join grups on grups.id = standings.id_grup order by standings.poin desc');

                $grup = DB::select('select id, grup from grups where season = ?', [$season]);

                return view("frontend.schedule.regular", ['schedule' => $scheduleRegular, 'day' => $day, 'standing' => $standing, 'grup' => $grup]);
            } else {
                $schedulePlayoff = DB::select("select schedules.*, timA.short_squad as timA, timB.short_squad as timB, timA.logo as logoA, timB.logo as logoB from schedules inner join tims as timA on timA.id = schedules.id_timA inner join tims as timB on timB.id = schedules.id_timB where schedules.babak = ?", [$babak]);
                // dd($schedule);
                $day = DB::select("select day from schedules order by day desc limit 1");
                $bannerPlayoff = DB::select('select playoff_banner from systems limit 1');
                return view('frontend.schedule.playoff', ['schedules' => $schedulePlayoff, 'day' => $day, 'playoff_banner' => $bannerPlayoff]);
            }
        }
    }
}
