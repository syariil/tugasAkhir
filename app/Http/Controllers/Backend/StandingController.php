<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Grups;
use App\Models\Standings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StandingController extends Controller
{
    public function index(Request $request)
    {
        //     $standings = DB::select('select standings.id, standings.id_tim, standings.id_grup, tims.squad , tims.season ,grups.grup, grups.id from standings INNER JOIN tims ON tims.id = standings.id_tim INNER JOIN grups on grups.id = standings.id_grup');
        //     $season = DB::select('select season from systems');
        //     $season = $season[0]->season;

        //     $grups = DB::select('select id, grup, season from grups where season = ?', [$season]);
        //     $tims = DB::select('select id, squad from tims where season = ?', [$season]);


        //     $arrayGrup = [];
        //     $arrayTim = [];

        //     // Iterasi setiap grup
        //     foreach ($grups as $grup) {
        //         $grupId = $grup->id;

        //         // Tambahkan nama grup ke array grup
        //         $arrayGrup[] = [
        //             'id_grup' => $grup->id,
        //             'grup' => $grup->grup,
        //             'season' => $grup->season,
        //         ];

        //         // Cari tim-tim dalam grup ini berdasarkan standings
        //         $timInGroup = array_filter($standings, function ($standing) use ($grupId) {
        //             return $standing->id_grup == $grupId;
        //         });

        //         // Ambil daftar nama tim dari standings
        //         $timNames = array_map(function ($standing) {
        //             return [
        //                 'id_tim' => $standing->id_tim,
        //                 'squad' => $standing->squad,
        //                 'id_grup' => $standing->id_grup,
        //             ];
        //         }, $timInGroup);

        //         // Tambahkan daftar tim ke array tim
        //         $arrayTim[] = $timNames;
        //     }
        //     return view('backend.standing.index', ['arrayTim' => $arrayTim, 'grup' => $arrayGrup, 'tims' => $tims]);
        // }

        // public function store(Request $request)
        // {
        //     // Validasi input
        //     // dump($request);
        //     $validated = $request->validate([
        //         'matches.*.id_grup' => 'required|integer',
        //         'matches.*.id_tim' => 'required|integer',
        //     ]);

        //     $season = DB::select('select season from systems limit 1');
        //     $season = $season[0]->season;

        //     foreach ($validated['matches'] as $match) {
        //         Standings::create([
        //             'id_grup' => $match['id_grup'],
        //             'id_tim' => $match['id_tim'],
        //             'game' => 0,
        //             'win' => 0,
        //             'lose' => 0,
        //             'winrate' => 0,
        //             'poin' => 0,
        //         ]);
        //     }

        //     return redirect()->route('standing.index')->with('success', 'standing add successfully!');
        // Ambil filter season dari request
        $selectedSeason = $request->input('season');

        // Ambil semua season untuk dropdown
        $seasons = DB::table('systems')->select('season')->distinct()->get();

        // Ambil season saat ini jika filter season kosong
        if (empty($selectedSeason)) {
            $selectedSeason = $seasons[0]->season;
        }

        // Query grup dan tim berdasarkan season yang dipilih
        $grups = DB::table('grups')
            ->select('id', 'grup', 'season')
            ->where('season', $selectedSeason)
            ->get();

        $tims = DB::table('tims')
            ->select('id', 'squad')
            ->where('season', $selectedSeason)
            ->get();

        // Query standings dengan join ke tabel grups dan tims
        $standings = DB::table('standings')
            ->select('standings.*', 'tims.squad', 'tims.season', 'grups.grup', 'grups.id as grup_id')
            ->join('tims', 'tims.id', '=', 'standings.id_tim')
            ->join('grups', 'grups.id', '=', 'standings.id_grup')
            ->where('tims.season', $selectedSeason)
            ->get();

        $arrayGrup = [];
        $arrayTim = [];

        // Iterasi setiap grup
        foreach ($grups as $grup) {
            $grupId = $grup->id;

            // Tambahkan nama grup ke array grup
            $arrayGrup[] = [
                'id_grup' => $grup->id,
                'grup' => $grup->grup,
                'season' => $grup->season,
            ];

            // Cari tim-tim dalam grup ini berdasarkan standings
            $timInGroup = array_filter($standings->toArray(), function ($standing) use ($grupId) {
                return $standing->id_grup == $grupId;
            });

            // Ambil daftar nama tim dari standings
            $timNames = array_map(function ($standing) {
                return [
                    'id_tim' => $standing->id_tim,
                    'squad' => $standing->squad,
                    'id_grup' => $standing->id_grup,
                ];
            }, $timInGroup);

            // Tambahkan daftar tim ke array tim
            $arrayTim[] = $timNames;
        }

        return view('backend.standing.index', [
            'arrayTim' => $arrayTim,
            'grup' => $arrayGrup,
            'tims' => $tims,
            'seasons' => $seasons,
            'selectedSeason' => $selectedSeason,
        ]);
    }

    public function editStanding(Standings $id)
    {
        $standing = DB::select('select standings.id, standings.game, standings.win, standings.lose, standings.winrate, standings.poin, tims.squad, grups.grup from standings inner join tims on tims.id = standings.id_tim inner join grups on grups.id = standings.id_grup where standings.id = ?', [$id->id]);
        return view("backend.standing.editStanding", ['standing' => $standing]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'matches.*.id_grup' => 'required|numeric',
            'matches.*.id_tim' => 'required|numeric',
        ]);

        foreach ($validated['matches'] as $match) {
            Standings::create([
                'id_grup' => $match['id_grup'],
                'id_tim' => $match['id_tim'],
                'game' => 0,
                'win' => 0,
                'lose' => 0,
                'winrate' => 0,
                'poin' => 0,
            ]);
        }

        return redirect()->route('standing.index')->with('success', 'add standing successfully!');
    }

    public function edit(Grups $id)
    {
        $grup = DB::select('select standings.id, standings.id_tim, standings.id_grup, standings.win, standings.lose, standings.winrate, standings.poin, tims.squad, grups.grup from standings inner join tims on tims.id = standings.id_tim inner join grups on grups.id = standings.id_grup where standings.id_grup = ? order by poin desc', [$id->id]);
        // dd($grup);
        return view('backend.standing.edit', ['grup' => $grup]);
    }
    public function update(Request $request, Standings $id)
    {
        // dump($request);
        $input = $request->validate([
            'game' => 'numeric',
            'win' => 'numeric',
            'lose' => 'numeric',
            'winrate' => 'numeric',
            'poin' => 'numeric',
        ]);
        $id->update($input);
        return redirect()->route('standing.edit', $id->id_grup)->with('success', 'Standing update successfully!');
    }

    public function delete(Standings $id)
    {
        $tim = DB::select('select squad from tims where id = ?', [$id->id_tim]);
        $id->delete();
        // dd($id->id_grup);
        return redirect()->route('standing.edit', $id->id_grup)->with('success', 'tim ' . $tim[0]->squad . ' delete successfully from standings!');
    }
}
