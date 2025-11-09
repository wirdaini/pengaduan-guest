<?php
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan form login
     */
    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    /**
     * Menampilkan form register
     */
    public function showRegisterForm()
    {
        return view('pages.auth.register');
    }

    /**
     * Memproses login
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Credentials untuk login
        $credentials = $request->only('email', 'password');
        $remember    = $request->has('remember');

        // Attempt login
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Redirect ke intended URL atau dashboard
            return redirect()->route('home')->with('success', 'Login berhasil! Selamat datang.');
        }

        // Jika login gagal
        return back()
            ->withErrors([
                'email' => 'Email atau password salah.',
            ])
            ->withInput($request->except('password'));

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // CEK DATA WARGA
            $dataWarga = Warga::where('user_id', auth()->id())->first();

            if (! $dataWarga) {
                // Jika data warga belum ada, redirect ke form data warga
                return redirect()->route('warga.create')
                    ->with('success', 'Login berhasil! Silakan lengkapi data warga dulu.');
            }

            // Jika data warga sudah lengkap, redirect ke pengaduan
            return redirect('/')->with('success', 'Login berhasil! Selamat datang.');
        }
    }

    /**
     * Memproses registrasi
     */
    public function register(Request $request)
    {
        // Debug dulu untuk melihat data yang dikirim
        \Log::info('Register attempt:', $request->all());

        $request->validate([
            'name'     => 'required|string|max:255', 
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'terms'    => 'required',
        ]);

        try {
            $user = User::create([
                'name'     => $request->name, // Sekarang menggunakan name
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

            auth()->login($user);

            return redirect()->route('login')->with('success', 'Registration successful!');

        } catch (\Exception $e) {
            return back()->with('error', 'Registration failed: ' . $e->getMessage());
        }
    }
    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Logout berhasil.');
    }
}
