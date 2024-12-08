<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter dari request
        $tim = $request->input('tim');
        $day = $request->input('day');

        // Query schedule dengan filter
        $query = DB::table('schedules')
            ->select(
                'schedules.*',
                'timA.short_squad as timA',
                'timB.short_squad as timB',
                'timA.logo as logoA',
                'timB.logo as logoB'
            )
            ->join('tims as timA', 'timA.id', '=', 'schedules.id_timA')
            ->join('tims as timB', 'timB.id', '=', 'schedules.id_timB')->orderBy('schedules.id', 'desc');

        // Terapkan filter season
        if (!empty($tim)) {
            $query->where('schedules.id_timA', $tim)->orWhere('schedules.id_timB', $tim);
        }

        // Terapkan filter day
        if (!empty($day)) {
            $query->where('schedules.day', $day);
        }

        // Pagination
        $schedule = $query->paginate(10); // 10 item per halaman

        // Ambil data season untuk dropdown
        $seasons = DB::table('systems')->select('season')->distinct()->get();

        // Ambil data tim untuk dropdown (season terkait)
        $squads = DB::table('tims')
            ->select('id', 'squad')
            ->where('season', '=', $seasons[0]->season)
            ->get();

        return view('backend.schedule.schedule', [
            'schedule' => $schedule,
            'seasons' => $seasons,
            'squads' => $squads,
        ]);

        // $schedule = DB::select("select schedules.*, timA.short_squad as timA, timB.short_squad as timB, timA.logo as logoA, timB.logo as logoB from schedules inner join tims as timA on timA.id = schedules.id_timA inner join tims as timB on timB.id = schedules.id_timB");
        // $season = DB::select('select season from systems limit 1');
        // $squad = DB::select('select id,squad from tims where season = ?', [$season[0]->season]);
        // return view('backend.schedule.schedule', ['squad' => $squad, 'schedule' => $schedule]);
    }

    public function store(Request $request)
    {
        $babak = DB::select("select babak from systems limit 1");
        // Validasi input
        $validated = $request->validate([
            'matches.*.timA' => 'required|integer',
            'matches.*.timB' => 'required|integer',
            'matches.*.day' => 'required|integer|max:10',
            'matches.*.time' => 'required|date_format:H:i',
            'matches.*.date' => 'required|date',
        ]);

        // Simpan setiap match ke tabel menggunakan model Schedule
        foreach ($validated['matches'] as $match) {
            Schedule::create([
                'id_timA' => $match['timA'],
                'id_timB' => $match['timB'],
                'scoreA' => 0,
                'scoreB' => 0,
                'day' => $match['day'],
                'time' => $match['time'],
                'date' => $match['date'],
                'babak' => $babak[0]->babak,
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('schedule.admin')->with('success', 'schedule saved successfully!');
    }

    public function edit(Schedule $id)
    {
        $schedule = DB::select('select schedules.*, timA.squad as timA, timB.squad as timB from schedules inner join tims as timA on timA.id = schedules.id_timA inner join tims as timB on timB.id = schedules.id_timB where schedules.id = ?', [$id->id]);
        $status = [
            [
                'value' => 'win',
                'name' => 'Win',
            ],
            [
                'value' => 'lose',
                'name' => 'Lose',
            ]
        ];

        // dump($schedule[0]);
        return view('backend.schedule.edit', ['schedule' => $schedule[0], 'status' => $status]);
    }

    public function update(Request $request, Schedule $id)
    {
        $babak = DB::select('select babak from systems limit 1');
        $babak = $babak[0]->babak;
        // dd($request);
        $input = $request->validate([
            'scoreA' => 'required|integer|min:0',
            'scoreB' => 'required|integer|min:0',
            'statusA' => 'string|nullable|in:win,lose',
            'statusB' => 'string|nullable|in:win,lose',
            'day' => 'required|integer|max:10',
            'time' => 'required',
            'date' => 'required|date',
        ]);
        if ($babak == 'regular') {
            // update poin tim
            $timA = DB::select('select * from standings where id_tim = ?', [$id->id_timA]);
            $timB = DB::select('select * from standings where id_tim = ?', [$id->id_timB]);
            $poin = DB::select("select poin from systems limit 1");
            $poin = $poin[0]->poin;
            if ($input['statusA'] != null) {
                // tim A
                if ($input['statusA'] == 'win') {
                    $timA[0]->poin += $poin;
                    $timA[0]->game += 1;
                    $timA[0]->win += 1;
                    $timA[0]->winrate += (($timA[0]->win / $timA[0]->game) * 100);
                    // dd($timA);
                    DB::update('update standings set poin = ?, game = ?, win = ?, winrate = ? where id_tim = ?', [$timA[0]->poin, $timA[0]->game, $timA[0]->win, $timA[0]->winrate, $timA[0]->id]);
                } else {
                    $timA[0]->game += 1;
                    $timA[0]->lose += 1;
                    $timA[0]->winrate -= (($timA[0]->win / $timA[0]->game) * 100);
                    // dd($timA);
                    DB::update('update standings set game = ?, lose = ?, winrate = ? where id_tim
                    = ?', [$timA[0]->game, $timA[0]->lose, $timA[0]->winrate, $timA[0]->id]);
                }
                // tim B
            }
            if ($input['statusB'] != null) {
                if ($input['statusB'] == 'win') {
                    $timB[0]->poin += $poin;
                    $timB[0]->game += 1;
                    $timB[0]->win += 1;
                    $timB[0]->winrate += (($timB[0]->win / $timB[0]->game) * 100);
                    // dd($timB);
                    DB::update('update standings set poin = ?, game = ?, win = ?, winrate = ? where id_tim = ?', [$timB[0]->poin, $timB[0]->game, $timB[0]->win, $timB[0]->winrate, $timB[0]->id]);
                } elseif ($input['statusB'] == 'lose') {
                    $timB[0]->game += 1;
                    $timB[0]->lose += 1;
                    $timB[0]->winrate -= (($timB[0]->win / $timB[0]->game) * 100);
                    // dd($timB);
                    DB::update('update standings set game = ?, lose = ?, winrate = ? where id_tim
                    = ?', [$timB[0]->game, $timB[0]->lose, $timB[0]->winrate, $timB[0]->id]);
                }
            }
        }
        $input['time'] = (new \DateTime($input['time']))->format('H:i');
        $id->fill($input)->save();

        return redirect()->route('schedule.admin')->with('success', 'schedule update successfully!');
    }

    public function delete(Schedule $id)
    {
        $id->delete();
        return redirect()->route('schedule.admin')->with('success', 'schedule delete successfully!');
    }
}
