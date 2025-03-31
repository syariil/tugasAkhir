<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TestModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index()
    {
        // for ($i = 1; $i <= 3; $i++) {

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
                'target' => '081380389486',
                'message' => "https://www.kabaenacup.my.id",
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . config("app.wa_token")
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // }
        dd(json_decode($response, true));
        // $tim = DB::select('select * from tests');
        // return view('backend.test', ['tim' => $tim]);
    }
    public function view($id)
    {
        $data = DB::select("select * from tests where id = ? limit 1", [$id]);
        if ($data) {
            return response()->json(['success' => true, 'data' => $data]);
        } else {
            return response()->json(['success' => false, 'message' => 'Data not found']);
        }
    }

    public function edit($id)
    {
        $data = DB::select("select * from tests where id = ? limit 1", [$id]);
        if ($data) {
            return view('partials.edit-modal', compact('data'));
        } else {
            return response()->json(['success' => false, 'message' => 'Data not found']);
        }
    }
}
