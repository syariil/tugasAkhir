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

        // ambil season
        $season = DB::select("select season from systems");
        $season = $season[0]->season;

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
            ->join('tims as timB', 'timB.id', '=', 'schedules.id_timB')->orderBy('schedules.id', 'desc')->where('timA.season', '=', $season)->orWhere('timB.season', '=', $season);

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
        $system = DB::selectOne('select babak, season, poin from systems limit 1');
        $babak = $system->babak;
        $season = $system->season;
        $poin = $system->poin;

        // Validasi input
        $input = $request->validate([
            'scoreA' => 'required|integer|min:0',
            'scoreB' => 'required|integer|min:0',
            'statusA' => 'nullable|string|in:win,lose',
            'statusB' => 'nullable|string|in:win,lose',
            'day' => 'required|integer|max:10',
            'time' => 'required',
            'date' => 'required|date',
        ]);

        if ($babak === 'regular') {
            // Update standings timA
            $timA = DB::selectOne('select * from standings where id_tim = ?', [$id->id_timA]);
            $timB = DB::selectOne('select * from standings where id_tim = ?', [$id->id_timB]);

            if ($input['statusA'] !== null) {
                $timA->game += 1;

                if ($input['statusA'] === 'win') {
                    $timA->poin += $poin;
                    $timA->win += 1;
                } elseif ($input['statusA'] === 'lose') {
                    $timA->lose += 1;
                }

                $timA->winrate = $timA->game > 0 ? ($timA->win / $timA->game) * 100 : 0;

                DB::update('update standings set poin = ?, game = ?, win = ?, lose = ?, winrate = ? where id_tim = ?', [
                    $timA->poin,
                    $timA->game,
                    $timA->win,
                    $timA->lose,
                    $timA->winrate,
                    $timA->id_tim,
                ]);
            }

            // Update standings timB
            if ($input['statusB'] !== null) {
                $timB->game += 1;

                if ($input['statusB'] === 'win') {
                    $timB->poin += $poin;
                    $timB->win += 1;
                } elseif ($input['statusB'] === 'lose') {
                    $timB->lose += 1;
                }

                $timB->winrate = $timB->game > 0 ? ($timB->win / $timB->game) * 100 : 0;

                DB::update('update standings set poin = ?, game = ?, win = ?, lose = ?, winrate = ? where id_tim = ?', [
                    $timB->poin,
                    $timB->game,
                    $timB->win,
                    $timB->lose,
                    $timB->winrate,
                    $timB->id_tim,
                ]);
            }
        }

        // Update schedule
        $input['time'] = (new \DateTime($input['time']))->format('H:i');
        $id->fill($input)->save();

        return redirect()->route('schedule.admin')->with('success', 'Schedule updated successfully!');
    }


    public function delete(Schedule $id)
    {
        $id->delete();
        return redirect()->route('schedule.admin')->with('success', 'schedule delete successfully!');
    }
}
