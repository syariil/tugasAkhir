<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\system;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function index()
    {

        if (System::exists()) {
            $system = system::first();
        } else {
            $system = null;
        }
        // dd($system);
        $babak = ['regular', 'playoff'];
        $registration = [
            [
                'name' => 'open',
                'value' => '1'
            ],
            [
                'name' => 'close',
                'value' => '0'
            ]
        ];
        $schedule = [
            [
                'name' => 'open',
                'value' => '1'
            ],
            [
                'name' => 'close',
                'value' => '0'
            ]
        ];
        // foreach ($registration as $item) {
        //     dump($item['name']);
        // }

        return view('backend.system', ["system" => $system, "babak" => $babak, "registration" => $registration, 'schedule' => $schedule]);
    }

    public function update(Request $request)
    {
        $input = $request->validate([
            "banner" => "file|mimes:jpeg,jpg,png|max:5120",
            "playoff_banner" => "file|mimes:jpeg,jpg,png|max:5120",
            "babak" => "required|in:playoff,regular",
            "registration" => "required|boolean",
            "schedule" => "required|boolean",
            "season" => "required|numeric",
            "poin" => "required|numeric",
        ]);

        // dd($input);
        $systems = system::first();

        if (empty($systems)) {
            $systems = new system();
            $systems->babak = $input['babak'];
            $systems->registration = $input['registration'];
            $systems->schedule = $input['schedule'];
            $systems->poin = $input['poin'];
            $systems->season = $input['season'];
            if ($request->hasFile('banner')) {
                $bannerFile = $request->file('banner');
                $bannerName = time() . '_banner.' . $bannerFile->getClientOriginalExtension();
                $bannerFile->storeAs('public/image/banner/', $bannerName);
                $systems->banner = $bannerName;
            }
            if ($request->hasFile('playoff_banner')) {
                $playoffFile = $request->file('playoff_banner');
                $playoffName = time() . 'playoff_banner.' . $playoffFile->getClientOriginalExtension();
                $playoffFile->storeAs('public/image/banner/', $playoffName);
                $systems->playoff_banner = $playoffName;
            }
            $systems->save();
        } else {
            $systems->babak = $input['babak'];
            $systems->registration = $input['registration'];
            $systems->schedule = $input['schedule'];
            $systems->poin = $input['poin'];
            $systems->season = $input['season'];
            if ($request->hasFile('banner')) {
                $bannerFile = $request->file('banner');
                // delete file old banner 
                $oldBanner = public_path('storage/banner/' . $systems->banner);
                if (file_exists($oldBanner)) {
                    unlink($oldBanner);
                }
                $bannername = time() . '_banner.' . $bannerFile->getClientOriginalExtension();
                $bannerFile->storeAs('public/image/banner', $bannername);
                $systems->banner = $bannername;
            }
            if ($request->hasFile('playoff_banner')) {
                $playoffFile = $request->file('playoff_banner');
                // delete file old banner 
                $oldPlayoffBanner = public_path('storage/banner/' . $systems->playoff_banner);
                if (file_exists($oldPlayoffBanner)) {
                    unlink($oldPlayoffBanner);
                }
                $filename = time() . '_banner.' . $playoffFile->getClientOriginalExtension();
                $playoffFile->storeAs('public/image/banner', $filename);
                $systems->playoff_banner = $filename;
            }
            $systems->save();
        }
        return redirect()->back()->with('success', 'system update successfully');
    }
}
