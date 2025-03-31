<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\system;
use App\Models\Tim;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        if ($request->has('search') && !empty($request->search)) {
            $query->where('username', 'like', '%' . $request->search . '%');
        }
        $user = $query->orderBy('role')->paginate(24);
        $user->appends(['search' => $request->search]);

        return view('backend.user.index', ['user' => $user]);
    }

    public function add()
    {
        $season = system::select('season')->first();
        $tim = Tim::select("id", "squad")->where('season', '=', $season->season)->get();
        return view("backend.user.add", ["tim" => $tim]);
    }

    public function edit(User $id)
    {
        $role = [
            [
                'name' => 'peserta',
                'value' => 'peserta'
            ],
            [
                'name' => 'admin',
                'value' => 'admin'
            ]
        ];
        $squad = Tim::query()->where('id', '=', $id->tim_id)->first();

        return view('backend.user.edit', ["user" => $id, "roles" => $role, "squad" => $squad]);
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'username' => 'required|string|unique:users,username',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,peserta',
            'tim_id' => 'required_if:role,peserta|nullable|exists:tims,id', // Tambahkan validasi ini
        ], [
            'tim_id.required_if' => 'Tim harus diisi jika role adalah peserta.', // Pesan error khusus
        ]);


        // simpan
        $user = new User();
        $user->username = $input['username'];
        $user->password = Hash::make($input['password']);
        $user->role = $input['role'];
        $user->tim_id = $input['tim_id'];
        $user->save();

        // Kirim pesan jika role adalah peserta
        if ($input['role'] === 'peserta' && $input['tim_id']) {
            $tim = Tim::where('id', $input['tim_id'])->first();

            if ($tim) {
                $message = "Hallo *" . $tim->leader . "*\n\nBerikut adalah akun Anda:\nUsername : *" . $input['username'] . "*\nPassword : *" . $input['password'] . "*\n\n*Catatan*:\nPassword ini bersifat rahasia dan sudah dienkripsi di sistem kami. Kami tidak dapat melihat password Anda setelah disimpan. Jika Anda lupa password, silakan hubungi kami untuk meresetnya.";

                $number = preg_replace("/.*?(8.*)/", "$1", $tim->no_whatsapp);
                $response = $this->send_message($number, $message);
            }
        }

        return redirect()->route('user.index')->with('update', $input['username'] . " berhasil ditambahkan");
    }

    public function update(Request $request, User $id)
    {
        $input = $request->validate([
            'username' => 'required|string',
            'password' => 'nullable|min:8',
            'role' => 'required|in:admin,peserta',
        ]);
        $check_password = $input['password'] !== null;
        $new_password = $check_password ? $input["password"] : $id->password;
        $input["password"] = Hash::check($new_password, $id->password) ? $id->password : Hash::make($input["password"]);
        // dd($id->tim_id);

        if ($id->tim_id !== null && $id->role === "peserta") {
            $tim = Tim::where('id', '=', $id->tim_id)->first();
            $message = "Hallo *" . $tim->leader . "*\n\nAkun anda telah di ubah dengan:\nUsername : *" . $input["username"] . "*\nPassword : " . $new_password . "\n\n*Note*:\nJika password yang ditampilkan adalah karakter acak sekitar 60 karakter, maka password anda adalah password yang dikirimkan sebelumnya. Password anda di enkripsi dan Kami tidak memiliki kemampuan untuk deskripsi/melihat password anda demi menjaga kebijakan dan privacy pengguna. Kami hanya dapat melakukan reset password anda jika anda melupakan password anda. Hubungi kami kembali jika ada hal yang ingin ditanyakan.";

            $number = preg_replace("/.*?(8.*)/", "$1", $tim->no_whatsapp);
            $response = $this->send_message($number, $message);
        }


        $id->fill($input)->save();

        return redirect()->route('user.index')->with('update', $id->username . " berhasil di update");
    }

    public function delete(User $id)
    {
        $id->delete();
        return redirect()->route('user.index')->with('delete', $id->username);
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
