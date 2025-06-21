<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{

    public function index()
    {
        $season = DB::select("select season from systems limit 1");
        $babak = DB::select("select babak from systems limit 1");
        $bannerPlayoff = DB::select('select playoff_banner from systems limit 1');
        $babak = $babak[0]->babak;
        $bannerPlayoff = $bannerPlayoff[0]->playoff_banner ?? null;
        $season = $season[0]->season;

        // get max day in standings
        $maxDay = DB::table('schedules')
            ->max('day');
        // get min day in standings
        $minDay = DB::table('schedules')
            ->min('day');

        // $grup = DB::select('select id, grup from grups where season = ?', [$season]);
        $grup = collect(DB::select('select id, grup from grups where season = ?', [$season]));
        // dd($grup->first()->id);

        return view("frontend.schedule.regular", ['minDay' => $minDay, 'maxDay' => $maxDay, 'grup' => $grup, 'playoff_banner' => $bannerPlayoff, 'babak' => $babak]);

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
