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
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'EMAIL TIDAK BOLEH KOSONG!',
            'password.required' => 'PASSWORD TIDAK BOLEH KOSONG ! ',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {

            if (Auth::user()->role == 'admin' || Auth::user()->role == 'walas' || Auth::user()->role == 'guru') {
                // Flash a welcome message
                session()->flash('success', 'Selamat datang, ' . Auth::user()->name . '!');
                return redirect('/beranda');
            }
        } else {
            return redirect('')->withErrors('Username dan password tidak sesuai !')->withInput();
        }
    }

    public function logout()
    {
        auth()->logout(); // Log the user out
        return redirect(''); // Redirect to the login page
    }
}
