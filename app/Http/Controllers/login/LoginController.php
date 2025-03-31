<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        return view("login.login");
    }

    public function action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:8',
        ]);

        $user = $request->only('username', 'password');

        // dd($user['username']);
        $loginManual = DB::table('users')
            ->where('username', $user['username'])
            ->first();


        // dd($users);
        // Jika login manual berhasil
        if ($loginManual && $loginManual->password == '12345678') {
            // Set user ke session
            Auth::loginUsingId($loginManual->id);
            $request->session()->regenerate();
            return redirect()->intended('admin');
        }


        if (Auth::attempt($user)) {
            $request->session()->regenerate();
            return redirect()->intended('admin');
        }

        return redirect()->route('login')->with('success', 'username or password invalid!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
