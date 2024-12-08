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
        $tim = DB::select('select * from tests');
        return view('backend.test', ['tim' => $tim]);
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
