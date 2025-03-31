<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter dari request
        $tim = $request->input('tim');
        $day = $request->input('day');

        // Ambil season dan babak
        $system = DB::table('systems')->select('season', 'babak')->first();
        $season = $system->season;
        $babak = $system->babak;

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
            ->join('tims as timB', 'timB.id', '=', 'schedules.id_timB')
            ->where('schedules.babak', '=', $babak) // Filter berdasarkan babak
            ->orderBy('schedules.day', 'desc');

        // Terapkan filter season
        if (!empty($tim)) {
            $query->where(function ($subQuery) use ($tim) {
                $subQuery->where('timA.squad', $tim)
                    ->orWhere('timB.squad', $tim);
            });
        }

        // Terapkan filter day
        if (!empty($day)) {
            $query->where('schedules.day', $day);
        }

        // Pagination
        $schedule = $query->paginate(6);
        // dd($schedule->items()[0]);

        // Ambil data tim untuk dropdown (season terkait)
        $squads = DB::table('tims')
            ->select('id', 'squad')
            ->where('season', '=', $season)
            ->get();

        return view('backend.schedule.schedule', [
            'schedule' => $schedule,
            'seasons' => $season,
            'squads' => $squads,
        ]);
    }


    public function view(Tim $id)
    {
        $squad = $id->squad;
        $query = DB::table('schedules')
            ->select(
                'schedules.*',
                'timA.short_squad as timA',
                'timB.short_squad as timB',
                'timA.logo as logoA',
                'timB.logo as logoB'
            )
            ->join('tims as timA', 'timA.id', '=', 'schedules.id_timA')
            ->join('tims as timB', 'timB.id', '=', 'schedules.id_timB')->orderBy('schedules.babak', 'desc')->where('timA.id', '=', $id->id)->orWhere('timB.id', '=', $id->id)->get();

        // dd($query);

        return view('backend.schedule.view', ["schedule" => $query, "squad" => $squad]);
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

        if ($babak === 'regular' && ($input["statusA"] !== null && $input["statusB"] !== null)) {
            // Update standings timA
            $timA = DB::selectOne('select * from standings where id_tim = ?', [$id->id_timA]);
            $timB = DB::selectOne('select * from standings where id_tim = ?', [$id->id_timB]);

            $timA->game += 1;
            $timB->game += 1;

            // update standing timA
            if ($input['statusA'] === 'win') {
                $timA->poin += $poin;
                $timA->win += 1;
                $timB->lose += 1;
            } elseif ($input['statusA'] === 'lose') {
                $timA->lose += 1;
                $timB->poin += $poin;
                $timB->win += 1;
            }

            $timA->winrate = $timA->game > 0 ? ($timA->win / $timA->game) * 100 : 0;
            $timB->winrate = $timB->game > 0 ? ($timB->win / $timB->game) * 100 : 0;

            // update tim A
            DB::update('update standings set poin = ?, game = ?, win = ?, lose = ?, winrate = ? where id_tim = ?', [
                $timA->poin,
                $timA->game,
                $timA->win,
                $timA->lose,
                $timA->winrate,
                $timA->id_tim,
            ]);

            // update tim B
            DB::update('update standings set poin = ?, game = ?, win = ?, lose = ?, winrate = ? where id_tim = ?', [
                $timB->poin,
                $timB->game,
                $timB->win,
                $timB->lose,
                $timB->winrate,
                $timB->id_tim,
            ]);
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

    public function notification(Request $request)
    {
        $request->validate(
            [
                "day" => "required",
                "time" => "required",
            ]
        );
        $input = $request->except("_token");
        $time = $input["time"];
        $day = (int)$input["day"];
        // dd($input);
        $system = DB::table('systems')->select('babak', 'season')->first();
        $season = $system->season;
        $babak = $system->babak;

        $schedule = DB::table('schedules')
            ->select(
                'schedules.*',
                'timA.squad as timA',
                'timB.squad as timB',
                'timA.no_whatsapp as noA',
                'timB.no_whatsapp as noB',
            )
            ->join('tims as timA', 'timA.id', '=', 'schedules.id_timA')
            ->join('tims as timB', 'timB.id', '=', 'schedules.id_timB')
            ->orderBy('schedules.babak', 'desc')
            ->where('schedules.babak', $babak)
            ->where(function ($query) use ($season) {
                $query->where('timA.season', $season)
                    ->orWhere('timB.season', $season); // Filter berdasarkan season
            })
            ->where(function ($query) use ($day) {
                $query->where('schedules.day', $day);
            })
            ->where(function ($query) use ($time) {
                $query->where('schedules.time', $time);
            })
            ->get();

        foreach ($schedule as $item) {
            $item->time = (new \DateTime($item->time))->format('H:i');
            $item->date =  (new \DateTime($item->date))->format("d F Y");

            $time = $item->time;
            $date = $item->date;
            $timA = (string)$item->timA;
            $timB = (string)$item->timB;
            $versus = $timA . " VS " . $timB;
            $noA = preg_replace("/.*?(8.*)/", "$1", $item->noA);
            $noB = preg_replace("/.*?(8.*)/", "$1", $item->noB);
            $number = [
                "A" => $noA,
                "B" => $noB,
            ];
            foreach ($number as $items) {
                // dd($items);
                $this->send_message($items, $versus, $time, $date);
            }
        }

        return redirect()->route('schedule.admin')->with('success', 'schedule ringthone for day ' . $day . ' successfully!');
    }

    private function send_message($number, $squad, $jam, $tanggal)
    {
        $season = DB::select("select season from systems limit 1");
        $season = $season[0]->season;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => '0' . $number,
                'message' => "Reminder!!,\n\nPertandingan anda  \n*" . $squad . "* \nakan dimulai pada : \n\nJam : " . $jam . " WITA\ntanggal : " . $tanggal,
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . config("app.wa_token")
            ),
        ));

        curl_exec($curl);
        if (curl_errno($curl)) {
            return false;
        }
        curl_close($curl);

        return true;
    }
}
