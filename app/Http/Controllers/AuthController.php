<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('login-form');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => [
                'required',
                'min:3',
                'regex:/[A-Z]/'
            ],
        ], [//menampilkan error kalau validasinya gagal
            'username.required' => 'Username wajib diisi!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 3 karakter!',
            'password.regex' => 'Password harus mengandung huruf kapital!',
        ]);

        if ($request->username === $request->password) {
            return view('login-success', ['username' => $request->username]);
        }

        return back()->withErrors(['login' => 'Username dan password tidak cocok!'])->withInput();
    }
}
