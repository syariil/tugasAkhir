<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Tim;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function index()
    {
        $register = DB::select('select registration from systems limit 1');
        if ($register[0]->registration == 1) {
            return view("frontend.register.open");
        } else {
            return view('frontend.register.close');
        }
    }

    public function store(Request $request)
    {
        // dd($request);
        $validate = 'required|max:45';
        $id_game = 'required|numeric|max_digits:24';
        $request->validate(
            [
                'leader' => $validate,
                'no_whatsapp' => 'required|numeric|max_digits:14',
                'squad' => $validate,
                'short_squad' => 'required|max:5',
                'logo' => 'file|mimes:jpeg,jpg,png|max:5120',
                'fee' => 'file|required|mimes:jpeg,jpg,png|max:5120',

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
        if ($request->file('logo')) {
            $logo = time() . '_' . $request->get('squad') . '_logo.' . $request->file('logo')->extension();
            // $request->file('logo')->move(public_path('image/logo'), $logo);

            $request->file('logo')->storeAs('public/image/logo/', $logo);
            $input['logo'] = $logo;
        }

        $fee = $request->get('squad') . '_fee.' . $request->file('fee')->extension();
        // $request->file('fee')->move(public_path('image/fee'), $fee);
        $request->file('fee')->storeAs('public/image/fee/', $fee);
        $input['fee'] = $fee;

        Registration::create($input);

        $squad = $request->get('squad');

        return redirect()->route('register')->with('success', $squad);
    }

    public function konf_register()
    {
        $registration = DB::table('registrations')->get();
        return view("backend.konf_register.index", ['data' => $registration]);
    }

    public function uprove($id)
    {
        try {
            DB::beginTransaction();

            // Mengambil fee berdasarkan ID
            $fee = DB::select('select fee from registrations where id = ? limit 1', [$id]);

            // Mendapatkan data tim berdasarkan ID
            $register = DB::table('registrations')->where('id', '=', $id)->select(
                'leader',
                'no_whatsapp',
                'squad',
                'short_squad',
                'logo',
                'nickname1',
                'id_nickname1',
                'nickname2',
                'id_nickname2',
                'nickname3',
                'id_nickname3',
                'nickname4',
                'id_nickname4',
                'nickname5',
                'id_nickname5',
                'nickname6',
                'id_nickname6'
            )->get();

            // Mendapatkan fee
            $fee = $fee[0]->fee;
            $season = DB::select('select season from systems');
            // Menambahkan field season ke setiap item
            foreach ($register as $item) {
                $item->season = $season[0]->season;
            }

            $registerArray = [];
            foreach ($register as $item) {
                $registerArray[] = (array) $item;  // Menambahkan array asosiatif per item
            }

            // $registerArray menambahkan array created_at dan updated_at
            $registerArray = array_map(function ($item) {
                $item['created_at'] = Carbon::now();
                $item['updated_at'] = Carbon::now();
                return $item;
            }, $registerArray);

            $tim = DB::select('select squad from tims where season = ? and squad = ?', [$season[0]->season, $register[0]->squad]);

            if (empty($tim)) {

                DB::table('tims')->insert($registerArray); // Casting menjadi array

                // Menghapus data registrasi yang sudah diproses
                DB::table('registrations')->where('id', '=', $id)->delete();

                DB::commit();

                // menghapus file fee registrasi yang sudah di proses
                if (Storage::exists('public/image/fee/' . $fee)) {
                    Storage::delete('public/image/fee/' . $fee);
                }



                return redirect()->route('konf_register')->with('success', 'pendaftaran tim ' . $register[0]->squad . ' berhasil di uprove');
            }
            return redirect()->route('konf_register')->with('delete', ' tim ' . $register[0]->squad . ' telah terdaftar');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function delete($id)
    {
        // Menghapus data tim
        $tim = DB::select('select squad, logo, fee from registrations where id = ? limit 1', [$id]);
        // menghapus file logo registrations
        // dump(Storage::exists('public/image/fee/test.jpg'));
        if (Storage::exists('public/image/logo/' . $tim[0]->logo)) {
            Storage::delete('public/image/logo/' . $tim[0]->logo);
        }
        // menghapus file fee registration
        if (Storage::exists('public/image/fee/' . $tim[0]->fee)) {
            Storage::delete('public/image/fee/' . $tim[0]->fee);
        }
        DB::table('registrations')->where('id', '=', $id)->delete();

        return redirect()->route('konf_register')->with('delete', 'pendaftaran tim ' . $tim[0]->squad . ' tidak diterima');
    }
}
