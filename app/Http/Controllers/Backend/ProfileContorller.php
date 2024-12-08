<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileContorller extends Controller
{
    public function index()
    {
        return view('backend.profile.index');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:8',
            'new_password' => 'required|min:8',
            'confirmed' => 'same:new_password'
        ]);


        if (Auth::user()->password == $request->old_password) {
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);


            return back()->with('success', 'password successfully changed!');
        }
        // macth old password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);


        return back()->with('success', 'password successfully changed!');
    }
}
