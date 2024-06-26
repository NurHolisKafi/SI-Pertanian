<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function AuthLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email:rfc,dns'],
            'password' => ['required'],
        ], [
            'email.email' => 'Email tidak valid'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            User::where('email', $credentials['email'])->update(['active' => true]);
            return redirect()->intended('/profile')->with('success', 'Login Berhasil');
        }

        return back()->withErrors([
            'error' => 'Email atau Password Salah',
        ])->onlyInput('email');
    }

    function AuthLoginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard')->with('success', 'Login Berhasil');
        }

        return back()->withErrors([
            'error' => 'Username atau Password Salah',
        ])->onlyInput('username');
    }

    function Logout(Request $request)
    {
        if (auth()->user()) {
            User::where('email', auth()->user()->email)->update(['active' => false]);
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
