<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Grups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrupController extends Controller
{
    public function index()
    {
        $grups = DB::select('select id,season, grup from grups');
        return view('backend.grup.index', ['grups' => $grups]);
    }

    public function store(Request $request)
    {
        // Validasi input
        // dump($request);
        $validated = $request->validate([
            'matches.*.grup' => 'required|string',
        ]);

        $season = DB::select('select season from systems limit 1');
        $season = $season[0]->season;

        foreach ($validated['matches'] as $match) {
            Grups::create([
                'grup' => $match['grup'],
                'season' => $season
            ]);
        }

        return redirect()->route('grup.index')->with('success', 'grups add successfully!');
    }

    public function edit(Grups $id)
    {

        return view('backend.grup.edit', ['grup' => $id]);
    }
    public function update(Request $request, Grups $id)
    {
        // dump($request);
        $input = $request->validate([
            'grup' => 'required|string',
        ]);
        $id->update($input);
        return redirect()->route('grup.index')->with('success', 'grups ' . $id->grup . ' update successfully!');
        // return view('backend.standing.editGrup', ['grup' => $id]);
    }

    public function delete(Grups $id)
    {
        $id->delete();
        return redirect()->route('grup.index')->with('success', 'grups ' . $id
            ->grup . ' delete successfully!');
    }
}
