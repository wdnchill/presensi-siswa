<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SesiController extends Controller
{
    public function index()
    {
        
        return view('Layouts.auth.login');
    }
    

    public function login(Request $request)
    {
        $request->validate([
            'username_or_email' => 'required',
            'password' => 'required',
        ], [
            'username_or_email.required' => 'USERNAME ATAU EMAIL TIDAK BOLEH KOSONG!',
            'password.required' => 'PASSWORD TIDAK BOLEH KOSONG!',
        ]);

        $credentials = $request->only('username_or_email', 'password');

        if (Auth::attempt(['email' => $credentials['username_or_email'], 'password' => $credentials['password']]) ||
            Auth::attempt(['username' => $credentials['username_or_email'], 'password' => $credentials['password']])) {
            return $this->redirectBasedOnRole();
        }

        // Jika otentikasi gagal, tampilkan pesan kesalahan yang sesuai
        notyf()->duration(10000)->position('x', 'right')->position('y', 'top')->dismissible(true)->addError('Email, username, atau password salah!');

        return redirect()->route('login')->withInput();
    }

    private function redirectBasedOnRole()
    {
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'walas' || Auth::user()->role == 'guru') {
            notyf()->duration(10000)->position('x', 'right')->position('y', 'top')->dismissible(true)->addSuccess('Selamat datang, ' . Auth::user()->name . '!');

            return redirect('');
        }

    }

    public function logout()
    {
        auth()->logout();

        notyf()->duration(2000)->position('x', 'center')->position('y', 'top')->addSuccess('Anda telah berhasil logout!');

        return redirect(''); 
    }
}
