<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'password.required' => 'PASSWORD TIDAK BOLEH KOSONG ! ',
        ]);

        $usernameOrEmail = $request->username_or_email;
        $password = $request->password;

        // Attempt to authenticate using email
        if (Auth::attempt(['email' => $usernameOrEmail, 'password' => $password])) {
            return $this->redirectBasedOnRole();
        }

        // Attempt to authenticate using username
        if (Auth::attempt(['username' => $usernameOrEmail, 'password' => $password])) {
            return $this->redirectBasedOnRole();
        }

        return redirect()->route('login')->withErrors('Username atau email dan password tidak sesuai!')->withInput();
    }

    private function redirectBasedOnRole()
    {
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'walas' || Auth::user()->role == 'guru') {
            // Flash a welcome message
            session()->flash('success', 'Selamat datang, ' . Auth::user()->name . '!');
            return redirect('');
        }
    }

    public function logout()
    {
        auth()->logout(); // Log the user out
        return redirect(''); // Redirect to the login page
    }
}
