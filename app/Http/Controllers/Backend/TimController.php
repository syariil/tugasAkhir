<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Tim;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TimController extends Controller
{
    public function index(Request $request)
    {
        $query = Tim::query();

        // Ambil season dari tabel systems
        $season = DB::table('systems')->value('season'); // Mengambil season langsung dengan value()

        // Pastikan kita hanya menampilkan tim dengan season yang sama dengan sistem

        // Jika ada parameter 'season' dari request, filter berdasarkan season yang diberikan
        $seasonSearch = $request->input('season');
        if (!empty($seasonSearch)) {
            $query->where('season', $seasonSearch);
        }

        // Pencarian berdasarkan squad, leader, atau no_whatsapp jika ada
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function ($q) use ($request) {
                // $q->where('squad', 'like', '%' . $request->search . '%')
                $q->where('squad', 'like', '%' . $request->search . '%')
                    ->orWhere('leader', 'like', '%' . $request->search . '%')
                    ->orWhere('no_whatsapp', 'like', '%' . $request->search . '%');
            });
        } else {
            $query->where('season', $season);
        }

        // Paginasi dan urutkan berdasarkan season
        $tim = $query->orderBy('season', 'desc')->paginate(32);
        // dd($tim->isEmpty());

        // Menambahkan parameter search dan season ke link pagination
        $tim->appends(['search' => $request->search, 'season' => $seasonSearch]);

        return view('backend.tim.tim', ['tim' => $tim, 'season' => $season]);
    }

    public function view(Tim $id)
    {
        $register = DB::table('systems')->select('registration')->first();
        $id->no_whatsapp = preg_replace("/.*?(8.*)/", "$1", $id->no_whatsapp);
        // dd($id->no_whatsapp);
        return view("backend.tim.view", ["tim" => $id, "registration" => $register->registration]);
    }

    public function edit(Tim $id)
    {
        // $id->no_whatsapp = preg_replace("/.*?(8.*)/", "$1", $id->no_whatsapp);
        return view('backend.tim.update', ["tim" => $id]);
    }

    public function update(Request $request, Tim $id)
    {
        $user = auth()->user();
        $rules = [
            'leader' => 'required|string|max:255',
            'no_whatsapp' => ["required", "digits_between:11,13", "regex:/^(62|0)8[1-9][0-9]{6,9}$/"],
            'squad' => 'required|string|max:255',
            'short_squad' => 'required|string|max:6',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'nickname1' => 'required|string',
            'id_nickname1' => 'required|numeric',
            'nickname2' => 'required|string|different:nickname1',
            'id_nickname2' => 'required|numeric|different:id_nickname1',
            'nickname3' => 'required|string|different:nickname1,nickname2',
            'id_nickname3' => 'required|numeric|different:id_nickname1,id_nickname2',
            'nickname4' => 'required|string|different:nickname1,nickname2,nickname3',
            'id_nickname4' => 'required|numeric|different:id_nickname1,id_nickname2,id_nickname3',
            'nickname5' => 'required|string|different:nickname1,nickname2,nickname3,nickname4',
            'id_nickname5' => 'required|numeric|different:id_nickname1,id_nickname2,id_nickname3,id_nickname4',
            'nickname6' => 'nullable|string|different:nickname1,nickname2,nickname3,nickname4,nickname5',
            'id_nickname6' => 'nullable|numeric|different:id_nickname1,id_nickname2,id_nickname3,id_nickname4,id_nickname5',
        ];

        // Tambahkan validasi season jika user adalah admin
        if ($user->is_admin) {
            $rules['season'] = 'required|numeric';
        }

        $request->validate(
            $rules,
            [
                'required' => ':attribute wajib diisi.',
                'regex' => ':attribute harus dimulai dengan 62 atau 0 dan diikuti angka 8.',
                'image' => ':atribute harus berupa file gambar',
                'mimes' => ':atribute hanya boleh memiliki format JPG, JPEG, PNG.',
                'logo.max' => ':atribute tidak boleh lebih dari 5MB.',
                'different' => ':attribute harus berbeda dari :other.',
                'max' => ':attribute tidak boleh lebih dari :max karakter.',
                'string' => ':attribute harus berupa text',
                'integer' => ':attribute harus berupa angka',
                'digits_between' => ':attribute harus memiliki panjang antara 11 hingga 13 digit.',
            ],
            [
                'leader' => 'Nama Ketua',
                'no_whatsapp' => 'Nomor WhatsApp',
                'squad' => 'Nama Squad',
                'short_squad' => 'Kependekan Nama Squad',
                'nickname1' => 'Nickname Player 1',
                'id_nickname1' => 'ID Player 1',
                'nickname2' => 'Nickname Player 2',
                'id_nickname2' => 'ID Player 2',
                'nickname3' => 'Nickname Player 3',
                'id_nickname3' => 'ID Player 3',
                'nickname4' => 'Nickname Player 4',
                'id_nickname4' => 'ID Player 4',
                'nickname5' => 'Nickname Player 5',
                'id_nickname5' => 'ID Player 5',
                'nickname6' => 'Nickname Player 6',
                'id_nickname6' => 'ID Player 6',
            ]
        );

        $input = $request->except('_token');
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $logo = $id->id . $id->season . time() . $request->get('squad') . '_logo.' . $file->extension();
            // $file->move(public_path('image/logo'), $logo);
            if ($id->logo !== 'logo.png') {
                if (Storage::exists('public/image/logo/' . $id->logo)) {
                    Storage::delete('public/image/logo/' . $id->logo);
                }
            }
            $file->storeAs('public/image/logo/', $logo);
            $input['logo'] = $logo;
        }

        $id->fill($input)->save();
        $update = $id->squad;
        if ($user->role === "peserta") {
            return redirect()->route('tim.view', $id->id)->with('update', 'tim ' . $update);
        }
        return redirect()->route('tim.index')->with('update', 'tim ' . $update);
    }

    public function delete(Tim $id)
    {
        if ($id->logo !== 'logo.png') {
            if (Storage::exists('public/image/logo/' . $id->logo)) {
                Storage::delete('public/image/logo/' . $id->logo);
            }
        }

        // menghapus user dengan id tim 
        $user = User::where('tim_id', $id->id)->get();
        foreach ($user as $u) {
            $u->delete();
        }

        $delete = $id->squad;
        $id->delete();
        return redirect()->route('tim.index')->with('delete', 'tim ' . $delete);
    }
}
