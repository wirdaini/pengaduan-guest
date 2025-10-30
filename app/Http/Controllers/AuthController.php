<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('login-form');
    }

    public function login(Request $request)
    {
        // VALIDATION (REQUIREMENT: validation)
        $request->validate([
            'email' => 'required|email', // REQUIREMENT: ganti username jadi email
            'password' => 'required|min:6'
        ], [
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 6 karakter!',
        ]);

        // CEK EMAIL DI DATABASE (REQUIREMENT: cek email)
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // REQUIREMENT: error message + repopulate form
            return back()->withErrors(['email' => 'Email tidak ditemukan!'])->withInput();
        }

        // CEK PASSWORD DENGAN Hash::check (REQUIREMENT: Hash::check)
        if (!Hash::check($request->password, $user->password)) {
            // REQUIREMENT: error message + repopulate form
            return back()->withErrors(['password' => 'Password salah!'])->withInput();
        }

        // LOGIN SUCCESS (REQUIREMENT: redirect ke dashboard)
        Auth::login($user);

        // REQUIREMENT: success message
        return redirect()->route('dashboard')->with('success', 'Login berhasil!');
    }

    // REQUIREMENT: logout function
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }
}
