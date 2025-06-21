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
        // ambil season dari sistem
        $season = DB::table('systems')->select('season')->first();
        $season = $season->season;

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
        
        // dd($tim);
        // dd($grups);
        // collect standing
                $standing = DB::select('select standings.id, standings.id_grup, standings.id_tim , standings.game, standings.win, standings.lose, standings.winrate, standings.poin, tims.short_squad,grups.grup from standings inner join tims on tims.id = standings.id_tim inner join grups on grups.id = standings.id_grup order by standings.poin desc');
        // dd($standing);

                $grup = DB::select('select id, grup from grups where season = ?', [$season]);


        return view('backend.standing.index', [
            'standing' => $standing,
            'grups' => $grups,
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
        return redirect()->route('standing.index', $id->id_grup)->with('success', 'Standing update successfully!');
    }

    public function delete(Standings $id)
    {
        $tim = DB::select('select squad from tims where id = ?', [$id->id_tim]);
        $id->delete();
        // dd($id->id_grup);
        return redirect()->route('standing.index', $id->id_grup)->with('success', 'tim ' . $tim[0]->squad . ' delete successfully from standings!');
    }
}
