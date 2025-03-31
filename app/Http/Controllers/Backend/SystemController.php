<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\system as table_system;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function index()
    {

        $system = table_system::exists() ? table_system::first() : null;
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

        // dd($system);

        return view('backend.system', ["system" => $system, "babak" => $babak, "registration" => $registration, 'schedule' => $schedule]);
    }

    public function update(Request $request)
    {
        $input = $request->validate([
            "banner" => "nullable|image|mimes:jpeg,jpg,png|max:5120",
            "playoff_banner" => "nullable|image|mimes:jpeg,jpg,png|max:5120",
            "babak" => "required|in:playoff,regular",
            "registration" => "required|boolean",
            "schedule" => "required|boolean",
            "season" => "required|numeric",
            "poin" => "required|numeric",
            "no_rek" => "nullable|numeric",
            "bank" => "nullable|string",
            "fee" => "nullable|string",
        ]);

        $input["fee"] = (int)str_replace('.', '', $input['fee']);

        $systems = table_system::first() ?? new table_system();
        $this->saveSystemData($systems, $input, $request);

        return redirect()->back()->with('success', 'System updated successfully');
    }

    private function saveSystemData($systems, $input, $request)
    {
        $systems->fill([
            'babak' => $input['babak'],
            'registration' => $input['registration'],
            'schedule' => $input['schedule'],
            'poin' => $input['poin'],
            'season' => $input['season'],
            'no_rek' => $input['no_rek'],
            'bank' => $input['bank'],
            'fee' => $input['fee'],
        ]);

        if ($request->hasFile('banner')) {
            $systems->banner = $this->uploadFile($request->file('banner'), $systems->banner, 'banner');
        }
        if ($request->hasFile('playoff_banner')) {
            $systems->playoff_banner = $this->uploadFile($request->file('playoff_banner'), $systems->playoff_banner, 'playoff_banner');
        }

        $systems->save();
    }

    private function uploadFile($file, $oldFilePath, $prefix)
    {
        if ($oldFilePath) {
            $oldPath = public_path('storage/banner/' . $oldFilePath);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $fileName = time() . "_{$prefix}." . $file->getClientOriginalExtension();
        $file->storeAs('public/image/banner', $fileName);

        return $fileName;
    }
}
