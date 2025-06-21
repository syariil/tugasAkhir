<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    // // get schedule api
    // public function getScheduleApi()
    // {
    //     $scheduleCheck = DB::select('select schedule from systems limit 1');
    //     $season = DB::select("select season from systems limit 1");
    //     $babak = DB::select("select babak from systems limit 1");
    //     $babak = $babak[0]->babak;
    //     $season = $season[0]->season;
    //     // dd($scheduleCheck[0]->schedule == 1);
    //     if ($scheduleCheck[0]->schedule == 1) {
    //         $scheduleRegular = DB::select("select schedules.*, timA.short_squad as timA, timB.short_squad as timB, timA.logo as logoA, timB.logo as logoB from schedules inner join tims as timA on timA.id = schedules.id_timA inner join tims as timB on timB.id = schedules.id_timB where schedules.babak = ? and (timA.season = ? or timB.season = ?)", [$babak, $season, $season]);

    //         return response()->json(['status' => 'success', 'data' => $scheduleRegular]);
    //     } else {
    //         return response()->json(['status' => 'error', 'message' => 'Schedule is not available']);
    //     }
    // }

    // // get standing api
    // public function getStandingApi()
    // {
    //     $season = DB::select("select season from systems limit 1");
    //     $season = $season[0]->season;
    //     $standing = DB::select('select standings.id, standings.id_grup, standings.game, standings.win, standings.lose, standings.winrate, standings.poin, tims.squad, grups.grup from standings inner join tims on tims.id = standings.id_tim inner join grups on grups.id = standings.id_grup where tims.season = ? order by standings.poin desc', [$season]);
    //     return response()->json(['status' => 'success', 'data' => $standing]);
    // }

    public function index()
    {
        $scheduleCheck = DB::select('select schedule from systems limit 1');
        $season = DB::select("select season from systems limit 1");
        $babak = DB::select("select babak from systems limit 1");
        $babak = $babak[0]->babak;
        $season = $season[0]->season;
        // dd($scheduleCheck[0]->schedule == 1);

        $scheduleRegular = DB::select("select schedules.*, timA.short_squad as timA, timB.short_squad as timB, timA.logo as logoA, timB.logo as logoB from schedules inner join tims as timA on timA.id = schedules.id_timA inner join tims as timB on timB.id = schedules.id_timB where schedules.babak = ? and (timA.season = ? or timB.season = ?)", [$babak, $season, $season]);

        // day collection
        $highestDay = DB::selectOne("select MAX(schedules.day) as highest_day from schedules inner join tims as timA on timA.id = schedules.id_timA inner join tims as timB on timB.id = schedules.id_timB where schedules.babak = ? and (timA.season = ? or timB.season = ?)", [$babak, $season, $season]);

        // get max day in standings
        $maxDay = DB::table('schedules')
            ->max('day');
        // get min day in standings
        $minDay = DB::table('schedules')
            ->min('day');

        // collect standing
        $standing = DB::select('select standings.id, standings.id_grup, standings.game, standings.win, standings.lose, standings.winrate, standings.poin, tims.squad,grups.grup from standings inner join tims on tims.id = standings.id_tim inner join grups on grups.id = standings.id_grup order by standings.poin desc');

        $grup = DB::select('select id, grup from grups where season = ?', [$season]);

        // get first id $grup
        // $grup = collect($grup)->first();

        return view("frontend.schedule.regular", ['schedules' => $scheduleRegular, 'minDay' => $minDay, 'maxDay' => $maxDay, 'standing' => $standing, 'grup' => $grup]);

        // $schedulePlayoff = DB::select("select schedules.*, timA.short_squad as timA, timB.short_squad as timB, timA.logo as logoA, timB.logo as logoB from schedules inner join tims as timA on timA.id = schedules.id_timA inner join tims as timB on timB.id = schedules.id_timB where schedules.babak = ? and (timA.season = ? or timB.season = ?)", [$babak, $season, $season]);

        // // day collection
        // $highestDay = DB::selectOne("select MAX(schedules.day) as highest_day from schedules inner join tims as timA on timA.id = schedules.id_timA inner join tims as timB on timB.id = schedules.id_timB where schedules.babak = ? and (timA.season = ? or timB.season = ?)", [$babak, $season, $season]);

        // // Ambil nilai tertinggi
        // $day = $highestDay->highest_day ?? 1;
        // $bannerPlayoff = DB::select('select playoff_banner from systems limit 1');
        // return view('frontend.schedule.playoff', ['schedules' => $schedulePlayoff, 'day' => $day, 'playoff_banner' => $bannerPlayoff]);

    }

    public function getSchedules($day = null)
    {
        $season = DB::table('systems')->value('season');

        $schedules = DB::table('schedules')
            ->join('tims as timA', 'timA.id', '=', 'schedules.id_timA')
            ->join('tims as timB', 'timB.id', '=', 'schedules.id_timB')
            ->select(
                'schedules.*',
                'timA.short_squad as timA',
                'timB.short_squad as timB',
                'timA.logo as logoA',
                'timB.logo as logoB'
            )
            ->where(function ($query) use ($season) {
                $query->where('timA.season', $season)
                    ->orWhere('timB.season', $season);
            })
            ->get()
            ->map(function ($item) {
                return (array)$item;
            });

        if ($day) {
            $schedules = $schedules->filter(function ($item) use ($day) {
                return $item['day'] == $day;
            });
        }

        return response()->json($schedules);
    }

    public function getStandings($id_grup)
    {
        $season = DB::table('systems')->value('season');

        $standings = DB::table('standings')
            ->join('tims', 'tims.id', '=', 'standings.id_tim')
            ->join('grups', 'grups.id', '=', 'standings.id_grup')
            ->select(
                'standings.id',
                'standings.id_grup',
                'standings.game',
                'standings.win',
                'standings.lose',
                'standings.winrate',
                'standings.poin',
                'tims.squad',
                'tims.short_squad',
                'tims.logo',
                'grups.grup'
            )
            ->where('grups.id', $id_grup)
            ->orderByDesc('standings.poin')
            ->get()
            ->map(function ($item) {
                return (array)$item;
            });

        return response()->json($standings);
    }

    public function getGroups()
    {
        $season = DB::table('systems')->value('season');

        $groups = DB::table('grups')
            ->where('season', $season)
            ->select('id', 'grup')
            ->get()
            ->map(function ($item) {
                return (array)$item;
            });

        return response()->json($groups);
    }


    //     public function index()
    // {
    //     $system = DB::table('systems')->first();
    //     $season = $system->season;
    //     $babak = $system->babak;

    //     $scheduleRegular = DB::table('schedules')
    //         ->join('tims as timA', 'timA.id', '=', 'schedules.id_timA')
    //         ->join('tims as timB', 'timB.id', '=', 'schedules.id_timB')
    //         ->select('schedules.*', 
    //                 'timA.short_squad as timA', 
    //                 'timB.short_squad as timB', 
    //                 'timA.logo as logoA', 
    //                 'timB.logo as logoB')
    //         ->where('schedules.babak', $babak)
    //         ->where(function($query) use ($season) {
    //             $query->where('timA.season', $season)
    //                   ->orWhere('timB.season', $season);
    //         })
    //         ->get();

    //     $dayStats = DB::table('schedules')
    //         ->join('tims as timA', 'timA.id', '=', 'schedules.id_timA')
    //         ->join('tims as timB', 'timB.id', '=', 'schedules.id_timB')
    //         ->select(
    //             DB::raw('MAX(schedules.day) as max_day'),
    //             DB::raw('MIN(schedules.day) as min_day')
    //         )
    //         ->where('schedules.babak', $babak)
    //         ->where(function($query) use ($season) {
    //             $query->where('timA.season', $season)
    //                   ->orWhere('timB.season', $season);
    //         })
    //         ->first();

    //     $standing = DB::table('standings')
    //         ->join('tims', 'tims.id', '=', 'standings.id_tim')
    //         ->join('grups', 'grups.id', '=', 'standings.id_grup')
    //         ->select('standings.*', 'tims.squad', 'grups.grup')
    //         ->where('grups.season', $season)
    //         ->orderByDesc('standings.poin')
    //         ->get();

    //     $grup = DB::table('grups')
    //         ->where('season', $season)
    //         ->select('id', 'grup')
    //         ->get();

    //     return view("frontend.schedule.test", [
    //         'schedules' => $scheduleRegular,
    //         'minDay' => $dayStats->min_day ?? 1,
    //         'maxDay' => $dayStats->max_day ?? 1,
    //         'standing' => $standing->map(function($item) {
    //             return (array)$item; // Konversi ke array
    //         })->toArray(),
    //         'grup' => $grup->map(function($item) {
    //             return (array)$item; // Konversi ke array
    //         })->toArray()
    //     ]);
    // }

    public function scheduleTest()
    {
        // get grup
        $season = DB::table('systems')->value('season');
        $grup = DB::table('grups')
            ->where('season', $season)
            ->select('id', 'grup')
            ->get();
        // dd($grup);
        return view("frontend.schedule.test", [
            'grup' => $grup,
        ]);
    }
}
