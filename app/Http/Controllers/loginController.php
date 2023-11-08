<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class loginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function username()
    {
        return 'username';
    }
    public function authentification(Request $request)
    {
        $credentials = $request->validate(
            [
                'username' => 'required|email:rfc,dns',
                'password' => 'required',
            ],
            [
                'required' => 'Tidak Boleh Kosong',
                'email' => 'Harus Format Email'
            ]
        );
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return back()->with('loginError', 'Email Atau Password Salah');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
