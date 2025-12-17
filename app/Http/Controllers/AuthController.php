<?php
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use App\Models\User;
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

        // PAKAI Auth::attempt() - INI YANG BENAR UNTUK LARAVEL!
        if (Auth::attempt([
            'email'    => $request->email,
            'password' => $request->password,
        ], $request->has('remember'))) {

            $request->session()->regenerate();

            // Dapatkan user yang baru login
            $user = Auth::user();

            return redirect()->route('dashboard')
                ->with('success', 'Login berhasil! Selamat datang ' . $user->name . '.');
        }

        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->withInput($request->except('password'));
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
            // TAMBAHKAN ROLE DEFAULT 'warga' SAAT REGISTRASI
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'warga', // DEFAULT ROLE UNTUK USER BARU
            ]);

            auth()->login($user);

            // ========== PERUBAHAN DI SINI ==========
            // Redirect ke DASHBOARD setelah registrasi
            return redirect()->route('dashboard')
                ->with('success', 'Registrasi berhasil! Selamat datang ' . $user->name . '.');
            // ========== END PERUBAHAN ==========

        } catch (\Exception $e) {
            return back()->with('error', 'Registrasi gagal: ' . $e->getMessage());
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
