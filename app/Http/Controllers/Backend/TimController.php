<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Tim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TimController extends Controller
{
    public function index(Request $request)
    {
        $query = Tim::query();
        if ($request->has('search') && !empty($request->search)) {
            $query->where('squad', 'like', '%' . $request->search . '%')
                ->orWhere('leader', 'like', '%' . $request->search . '%')
                ->orWhere('no_whatsapp', 'like', '%' . $request->search . '%');
        }
        $tim = $query->orderBy('season', 'desc')->paginate(10);
        $tim->appends(['search' => $request->search]);


        // dump($tim);
        return view('backend.tim.tim', ['tim' => $tim]);
    }

    public function view()
    {
        return view("backend.tim.view");
    }

    public function edit($id)
    {
        $tim = DB::select('select * from tims where id = ?', [$id]);
        // dump($tim[0]->squad);
        return view('backend.tim.update', ["tim" => $tim]);
    }

    public function update(Request $request, Tim $id)
    {
        $validate = 'required|max:45';
        $id_game = 'required|numeric|max_digits:24';
        $request->validate(
            [
                'leader' => $validate,
                'no_whatsapp' => 'required|numeric|max_digits:14',
                'squad' => $validate,
                'short_squad' => 'required|max:5',
                'logo' => 'file|mimes:jpeg,jpg,png|max:5120',

                'nickname1' => $validate,
                'id_nickname1' => $id_game,
                'nickname2' => $validate,
                'id_nickname2' => $id_game,
                'nickname3' => $validate,
                'id_nickname3' => $id_game,
                'nickname4' => $validate,
                'id_nickname4' => $id_game,
                'nickname5' => $validate,
                'id_nickname5' => $id_game,
                'nickname6' => 'max:45',
                'id_nickname6' => 'max:24',

            ]
        );

        $input = $request->except('_token');
        $file = $request->file('logo');
        if ($file) {
            $logo = $request->get('squad') . '_logo.' . $file->extension();
            // $file->move(public_path('image/logo'), $logo);
            if ($id->log !== 'logo.png') {
                if (Storage::exists('public/image/logo/' . $id->log)) {
                    Storage::delete('public/image/logo/' . $id->logo);
                }
            }
            $file->storeAs('public/image/logo/', $logo);
            $input['logo'] = $logo;
        }

        $id->fill($input)->save();
        $update = $id->squad;
        return redirect()->route('tim')->with('update', 'tim ' . $update);
    }

    public function delete(Tim $id)
    {
        if ($id->logo !== 'logo.png') {
            if (Storage::exists('public/image/logo/' . $id->logo)) {
                Storage::delete('public/image/logo/' . $id->logo);
            }
        }
        $delete = $id->squad;
        $id->delete();
        return redirect()->route('tim')->with('delete', 'tim ' . $delete);
    }
}
