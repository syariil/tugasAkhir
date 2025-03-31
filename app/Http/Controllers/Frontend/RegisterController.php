<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Tim;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function index()
    {
        $system = DB::select('select registration, fee, bank, no_rek, season from systems limit 1');
        // dd($system);
        $system = $system[0];
        return view("frontend.register." . ($system->registration == 1 ? "open" : "close"), ["system" => $system]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'leader' => 'required|string|max:255',
                'no_whatsapp' => ["required", "digits_between:11,13", "regex:/^(62|0)8[1-9][0-9]{6,9}$/"],
                'squad' => 'required|string|max:255',
                'short_squad' => 'required|string|max:6',
                'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
                "fee" => "required|image|mimes:jpeg,jpg,png|max:5120",
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
            ],
            [
                'required' => ':attribute wajib diisi.',
                'regex' => ':attribute harus dimulai dengan 62 atau 0 dan diikuti angka 8.',
                'image' => ':atribute harus berupa file gambar',
                'mimes' => ':attribute hanya boleh memiliki format JPG, JPEG, PNG.',
                'logo.max' => ':attribute tidak boleh lebih dari 5MB.',
                'fee.max' => ':attribute tidak boleh lebih dari 5MB.',
                'different' => ':attribute harus berbeda dari player lain .',
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
        $input["no_whatsapp"] = "0" . preg_replace("/.*?(8.*)/", "$1", $input["no_whatsapp"]);
        $input["no_whatsapp"] = (int)$input["no_whatsapp"];
        // dd($input["no_whatsapp"]);

        if ($request->file('logo')) {
            $logo = time() . '_' . $request->get('squad') . '_logo.' . $request->file('logo')->extension();
            // $request->file('logo')->move(public_path('image/logo'), $logo);

            $request->file('logo')->storeAs('public/image/logo/', $logo);
            $input['logo'] = $logo;
        }

        $fee = time() . '_' . $request->get('squad') . '_fee.' . $request->file('fee')->extension();
        // $request->file('fee')->move(public_path('image/fee'), $fee);
        $request->file('fee')->storeAs('public/image/fee/', $fee);
        $input['fee'] = $fee;

        Registration::create($input);

        $squad = $request->get('squad');

        return redirect()->route('register')->with('success', $squad);
    }

    public function konf_register()
    {
        // dd();
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
            $register = DB::table('registrations')->where('id', $id)->first();

            if (!$register) {
                return redirect()->route('konf_register')->with('delete', 'Data registrasi tidak ditemukan.');
            }

            // Mendapatkan fee
            $fee = $fee[0]->fee;
            $season = DB::select('select season from systems');
            $season = $season[0]->season;
            // Menambahkan field season ke setiap item
            $timData = [
                'leader' => $register->leader,
                'no_whatsapp' => $register->no_whatsapp,
                'squad' => $register->squad,
                'short_squad' => $register->short_squad,
                'logo' => $register->logo,
                'nickname1' => $register->nickname1,
                'id_nickname1' => $register->id_nickname1,
                'nickname2' => $register->nickname2,
                'id_nickname2' => $register->id_nickname2,
                'nickname3' => $register->nickname3,
                'id_nickname3' => $register->id_nickname3,
                'nickname4' => $register->nickname4,
                'id_nickname4' => $register->id_nickname4,
                'nickname5' => $register->nickname5,
                'id_nickname5' => $register->id_nickname5,
                'nickname6' => $register->nickname6,
                'id_nickname6' => $register->id_nickname6,
                'season' => $season,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            // dd($timData['no_whatsapp']);

            $tim = DB::select('select squad from tims where season = ? and squad = ?', [$season, $timData['squad']]);

            if (empty($tim)) {

                $timId = DB::table('tims')->insertGetId($timData); // Casting menjadi array

                // Menghapus data registrasi yang sudah diproses
                DB::table('registrations')->where('id', '=', $id)->delete();


                // menghapus file fee registrasi yang sudah di proses
                if (Storage::exists('public/image/fee/' . $fee)) {
                    Storage::delete('public/image/fee/' . $fee);
                }

                // membuat user tim
                $username = str_replace(" ", "_", strtolower($timData['squad'])) . (string)$timData["season"];
                $password = "pass-" . rand(1000, 9999);
                DB::table('users')->insert([
                    'tim_id' => $timId,
                    'username' => $username,
                    'password' => Hash::make($password),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::commit();
                $message = "Selamat " . $timData['leader'] . ",\n tim " . $timData['squad'] . " telah terdaftar di turnamen Kabaena Cup season $season. Silakan login ke : \n\n" . route("login") . "\n\n" . "Untuk melihat detail tim atau mengedit tim Anda selama dalam proses pendaftaran serta anda dapat melihat jadwal penrtandigan tim anda.\nUsername: " . $username . "\n" . "Password: " . $password;
                $send_message = $this->send_message($timData["no_whatsapp"], $message);

                if ($send_message) {
                    return redirect()->route('konf_register')->with('success', "tim " . $timData["squad"] . " pendaftaran di setujui");
                }
                return redirect()->route('konf_register')->with('delete', "tim " . $timData["squad"] . " gagal mengirim pesan!");
            }
            return redirect()->route('konf_register')->with('delete', ' tim ' . $timData['squad'] . ' telah terdaftar');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function delete($id)
    {
        // Menghapus data tim
        $tim = DB::select('select leader, no_whatsapp, squad, logo, fee from registrations where id = ? limit 1', [$id]);
        if ($tim) {
            if (!empty($tim[0]->logo) && Storage::exists('public/image/logo/' . $tim[0]->logo) && $tim[0]->logo !== "logo.png") {
                Storage::delete('public/image/logo/' . $tim[0]->logo);
            }
            if (!empty($tim[0]->fee) && Storage::exists('public/image/fee/' . $tim[0]->fee)) {
                Storage::delete('public/image/fee/' . $tim[0]->fee);
            }
            DB::table('registrations')->where('id', '=', $id)->delete();

            $message = "Hallo " . $tim[0]->leader . ",\n pendaftaran tim anda *" . $tim[0]->squad . "* ditolak dikarenakan tidak memenuhi persyaratan atau terdapat kesalahan dalam pedaftaran anda. silahkan untuk mendaftar ulang diwebsite resmi kami.\n\n" . route("register");

            $send_message = $this->send_message($tim[0]->no_whatsapp, $message);
            if ($send_message) {
                return redirect()->route('konf_register')->with('delete', "tim " . $tim[0]->squad . " pendaftaran di tolak");
            }

            return redirect()->route('konf_register')->with('delete', 'pendaftaran tim ' . $tim[0]->squad . ' gagal mengirim pesan');
        }

        return redirect()->route('konf_register')->with('delete', 'Data tidak ditemukan.');
    }

    private function send_message($number, $message)
    {
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
                'message' => $message,
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . config("app.wa_token")
            ),
        ));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            return false;
        }
        curl_close($curl);

        return true;
    }
}
