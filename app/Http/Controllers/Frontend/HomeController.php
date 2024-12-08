<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $banner = DB::select('select banner from systems');
        $highlight = DB::select('select * from highlights order by id desc limit 5');
        return view("frontend.home", ["banner" => $banner, "highlight" => $highlight]);
    }
}
