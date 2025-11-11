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
        ], [
            'email.required'    => 'Alamat email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min'      => 'Kata sandi minimal 6 karakter.',
        ]);

        // STEP 1: Cari user by email
        $user = User::where('email', $request->email)->first();

        // STEP 2: CEK EMAIL
        if (! $user) {
            return back()
                ->withErrors(['email' => 'Email tidak ditemukan dalam sistem.'])
                ->withInput($request->except('password'));
        }

        // STEP 3: CEK PASSWORD dengan Hash::check
        if (! Hash::check($request->password, $user->password)) {
            return back()
                ->withErrors(['password' => 'Password yang Anda masukkan salah.'])
                ->withInput($request->except('password'));
        }

        // STEP 4: LOGIN BERHASIL
        Auth::login($user, $request->has('remember'));
        $request->session()->regenerate();

        // STEP 5: CEK DATA WARGA
        $dataWarga = Warga::where('user_id', auth()->id())->first();

        if (! $dataWarga) {
            // JIKA BELUM ADA DATA WARGA → ke form warga
            return redirect()->route('warga.create')
                ->with('success', 'Login berhasil! Silakan lengkapi data warga dulu.');
        }

        // JIKA SUDAH ADA DATA WARGA → ke home (sesuai kode awal Anda)
        return redirect()->route('home')->with('success', 'Login berhasil! Selamat datang.');
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
        ], [
            'name.required'      => 'Nama lengkap wajib diisi.',
            'email.required'     => 'Alamat email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email ini sudah terdaftar.',
            'password.required'  => 'Kata sandi wajib diisi.',
            'password.min'       => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'terms.required'     => 'Anda harus menyetujui syarat dan ketentuan.',
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
